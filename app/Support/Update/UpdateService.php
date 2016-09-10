<?php


namespace Reactor\Support\Update;


use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;
use GuzzleHttp\Stream\Stream;
use Symfony\Component\HttpFoundation\Response;

class UpdateService {

    /** @var string */
    const releasesURL = 'https://api.github.com/repos/nuclearcms/nuclear/releases';

    /** @var GuzzleClient */
    protected $httpClient;

    /** @var array */
    protected $releases;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->httpClient = new Client();
    }

    /**
     * Returns available releases
     *
     * @return array
     */
    public function getReleases()
    {
        if ($this->releases)
        {
            return $this->releases;
        }

        try
        {
            $response = $this->httpClient->get(static::releasesURL);

            if (Response::HTTP_OK === $response->getStatusCode())
            {
                $this->releases = json_decode($response->getBody());

                return $this->releases;
            }

            return false;
        } catch (RequestException $e)
        {
            return false;
        }
    }

    /**
     * Checks if the nuclear version is the latest
     *
     * @return bool
     */
    public function isNuclearCurrent()
    {
        return (version_compare(
                nuclear_version(),
                $this->getLatestRelease()->tag_name
            ) >= 0);
    }

    /**
     * Returns the latest release
     */
    public function getLatestRelease()
    {
        foreach ($this->getReleases() as $release)
        {
            if ($release->draft === false)
            {
                return $release;
            }
        }

        return null;
    }

    /**
     * Downloads the latest update and stores it in the temporary folder
     *
     * @return string
     */
    public function downloadLatest()
    {
        $downloadURL = $this->getLatestDownloadLink();

        return $this->downloadUpdateFromURL($downloadURL);
    }

    /**
     * Validates the latest update and returns the download link
     *
     * @return string
     */
    protected function getLatestDownloadLink()
    {
        $latest = $this->getLatestRelease();

        if ( ! isset($latest->assets[0]) or empty($latest->assets[0]->browser_download_url))
        {
            abort(500, trans('update.no_archive_to_download'));
        }

        return $latest->assets[0]->browser_download_url;
    }

    /**
     * Downloads and stores the update in temporary folder
     *
     * @param string $downloadURL
     * @return string
     */
    protected function downloadUpdateFromURL($downloadURL)
    {
        $fileName = tempnam(sys_get_temp_dir(), 'nuclear_update.zip');
        $resource = fopen($fileName, 'w');
        $stream = Stream::factory($resource);

        with(new Client())->get($downloadURL, ['save_to' => $stream]);

        return $fileName;
    }

    /**
     * Extracts the update in the supplied path
     *
     * @param string $path
     * @param ExtractionService
     * @return string
     */
    public function extractUpdate($path, ExtractionService $extractor)
    {
        return $extractor->extract($path);
    }

    /**
     * Moves the extracted files in the supplied path
     *
     * @param string $path
     * @param ExtractionService $extractor
     */
    public function moveUpdate($path, ExtractionService $extractor)
    {
        \Artisan::call('down');

        $extractor->move($path);

        \Artisan::call('up');
    }

    /**
     * Finalizes the update process
     */
    public function finalizeUpdate()
    {
        \Artisan::call('cache:clear');
        \Artisan::call('route:cache');
        \Artisan::call('migrate');
        \Artisan::call('optimize', ['--force' => true]);
    }

}