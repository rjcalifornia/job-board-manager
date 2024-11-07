# Job Board Manager for Elgg


<p align="center">
  
<img src="https://raw.githubusercontent.com/rjcalifornia/job-board-manager/refs/heads/master/assets/jobs-for-elgg.png" width="562">

<br>
</p>

## Main Features


### Requirements
* PHP 8.2.x
* Composer
* NodeJS
* NPM
* elgg 6.x

## Installation | Elgg
- Download from the elgg repository
- Unzip in the mod folder
- Place at the bottom of the list and activate it

## Installation | Dev
- Clone this repository
- Run ``` composer install ``` to install the required PHP dependencies
- Run ``` npm install ``` to install BootStrap Icons and Tailwindcss

## Customizing with Tailwind CSS
- Run  ``` npx tailwindcss -i ./src/input.css -o ./src/output.css --watch ``` 
- Add the desired Tailwind CSS classes to the ``` index.html ``` file in the ``` src ``` folder

## Dependencies

- [Twig 3.14](https://twig.symfony.com/) - Twig is a modern template engine for PHP
- [Ramsey Uuid 4.7](https://uuid.ramsey.dev/en/stable/) - A PHP library for generating and working with universally unique identifiers (UUIDs).
- [BootStrap Icons](https://icons.getbootstrap.com/) - Free, high quality, open source icon library with over 2,000 icons.
- [Tailwind CSS](https://tailwindcss.com/) - A utility-first CSS framework packed with classes to build any design, directly in your markup.