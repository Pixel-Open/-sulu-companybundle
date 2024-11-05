# Sulu Company bundle

![GitHub release (with filter)](https://img.shields.io/github/v/release/Pixel-Developpement/sulu-companybundle?style=for-the-badge)
[![Dependency](https://img.shields.io/badge/sulu-2.5-cca000.svg?style=for-the-badge)](https://sulu.io/)

## Presentation

A Sulu bundle to easily manage the company information.

## Features
* Company information management
* Manual or automatic (via Google My Business) hours management

## Requirements

* PHP >= 8.0
* Sulu >= 2.5
* Symfony >= 5.4

## Installation

### Install the bundle

Execute the following [composer](https://getcomposer.org/) command to add the bundle to the dependencies of your
project:

```bash
composer require pixeldev/sulu-companybundle --with-all-dependencies
```

### Enable the bundle

Enable the bundle by adding it to the list of registered bundles in the `config/bundles.php` file of your project:

 ```php
 return [
     /* ... */
     Pixel\CompanyBundle\CompanyBundle::class => ['all' => true],
 ];
 ```

### Update schema
```shell script
bin/console do:sch:up --force
```

## Bundle Config

Define the Admin Api Route in `routes_admin.yaml`
```yaml
company.setting_api:
  type: rest
  prefix: /admin/api
  resource: pixel_company.settings_route_controller
  name_prefix: company.
```

## Use
## General use
To access the company settings, on the administration interface, go to the Settings section and click on "Company management".
Once on the form, fill the fields that are relevant/useful for your needs.

Do not forget to click on "Save" to have the information stored and available.

## Twig extension
This bundle comes with several twig function that you can use to get the previously filled information: 

**company_settings()**: returns all the settings of the company. No parameters are required.

Example of use:
```twig
{% set companySettings = company_settings() %}
<p>{{ companySettings.name }}</p>
```

**get_company_hours()**: renders a view which display the hours of the company (no matter the way they have been filled). No parameters are required.

Example of use:
```twig
<div id="myHours">
    {{ get_company_hours() }}
</div>
```

**get_google_review()**: returns the average rating and the total rating. No parameters are required.

Example of use:
```twig
{% set ratingInfo = get_google_review() %}
    {% if ratingInfo is not null %}
        <div class="noteGoogle">
            <p>Note : {{ ratingInfo.rating }}</p>
            <ul class="star">
                <li><img src="{{ asset('/assets/images/noteGoogle/star.svg') }}" alt=""></li>
                <li><img src="{{ asset('/assets/images/noteGoogle/star.svg') }}" alt=""></li>
                <li><img src="{{ asset('/assets/images/noteGoogle/star.svg') }}" alt=""></li>
                <li><img src="{{ asset('/assets/images/noteGoogle/star.svg') }}" alt=""></li>
                <li><img src="{{ asset('/assets/images/noteGoogle/star.svg') }}" alt=""></li>
                <li>
                    More than <strong>{{ ratingInfo.total_rating }}</strong> avis
                </li>
            </ul>
        </div>
    {% endif %}
```

### Use Google My Business
To retrieve the hours of the company via Google, fill the place ID and the API key fields and check the "Use the hours stored in Google My Business?".
Then, you need to run the following command:
```bash
bin/console sync:google:informations
```

This will retrieve, the rating, the opening hours and the total number of rating available and are ready to use. 

## Contributing
You can contribute to this bundle. The only thing you must do is respect the coding standard we implements.
You can find them in the `ecs.php` file.
