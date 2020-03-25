<h2> Windows boilerPlate </h2>
<ol style="list-style: none">
 <li>Installer PhpStorm</li>
 <li>Installer PhP none thread safe og composer følg Guide: https://devanswers.co/install-composer-php-windows-10/ </li>
 <li>Installer laravel Installer " con </li>
 <li>opret projekt mappe ( cd /sites " mkdir projektnavn " ) </li>
 <li>git clone https://github.com/Eigilak/laravelBoiler.git </li>
 <li>Tilgå phpstorms terminal </li>
 <li>kør " composer install "</li>
 <li>kør " php artisan key:generate "</li>
 <li> husk at installere NodeJS https://nodejs.org/en/download/ </li>
 <li> kør " composer require laravel/ui " ( til login )  </li>
 <li> kør " npm install " i projekt-mappe - for at installere node i projekt</li>
 <li> kør " npm install -g sass " </li>
 <li> enable fileWatcher under indstillinger ( CTRL + ALT + S ) /tools/filewatcher/ </li>
 <li> Tilføj scss med Plus --> og vælg SCSS </li>
 <li> Opsæt database i mysql --> create database navn</li>
 <li> Opsæt forbindelse til DB via .ENV filen i roden </li>
 <li> migrerer din db med php artisan migrate:fresh </li>
 <li> kør " php artisan serve "</li>
</ol>

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
