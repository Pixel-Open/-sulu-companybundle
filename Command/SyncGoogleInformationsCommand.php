<?php

namespace Pixel\CompanyBundle\Command;

use Doctrine\ORM\EntityManagerInterface;
use Pixel\CompanyBundle\Entity\Setting;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Contracts\HttpClient\HttpClientInterface;

class SyncGoogleInformationsCommand extends Command
{
    protected static $defaultName = "sync:google:informations";
    protected static $defaultDescription = "Synchronizes the informations with the ones from Google";
    private EntityManagerInterface $entityManager;
    private HttpClientInterface $client;

    public function __construct(
        EntityManagerInterface $entityManager,
        HttpClientInterface $client,
        string $name = null
    )
    {
        $this->entityManager = $entityManager;
        $this->client = $client;
        parent::__construct($name);
    }

    protected function configure()
    {
        $this->setHelp("Synchronizes the informations with the ones from Google");
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $output->writeln("Synchronization...");
        $setting = $this->entityManager->getRepository(Setting::class)->findOneBy([]);
        $placeId = $setting->getPlaceId();
        $apiKey = $setting->getApiKey();
        if($placeId){
            $response = $this->client->request("GET", "https://maps.googleapis.com/maps/api/place/details/json", [
                "query" => [
                    "placeid" => $placeId,
                    "fields" => "rating,opening_hours,user_ratings_total",
                    "key" => $apiKey
                ]
            ]);
            if($response->getStatusCode() === 200){
                $content = $response->toArray();
                if($content['status'] === "INVALID_REQUEST"){
                    throw new \Exception("The place ID might not be correct. Please check it in the administration interface");
                }
                if($content['status'] === "REQUEST_DENIED") {
                    throw new \Exception($content['error_message']);
                }
                $setting->setGoogleMyBusiness($content);
                $this->entityManager->persist($setting);
                $this->entityManager->flush();
                $output->writeln("<info>Synchronization ended sucessfully!</info>");
                return self::SUCCESS;
            }else{
                $output->writeln("<error>An error occurs during the synchronisation</error>");
                return self::FAILURE;
            }
        }
        $output->writeln("<error>There is no 'place ID' registered in the company settings</error>");
        return self::FAILURE;
    }
}
