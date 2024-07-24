<p align="center">
<img src="https://raw.githubusercontent.com/Zen0x7/ServiceBench/master/public/logo.svg" alt="Service Bench" height="100">
</p>

<h1 align="center">Service Bench</h1>

<p align="center">
<a href="https://github.com/Zen0x7/ServiceBench/actions/tests.yml"><img src="https://github.com/Zen0x7/ServiceBench/actions/workflows/tests.yml/badge.svg" alt="Tests"></a>
<a href="https://github.com/Zen0x7/ServiceBench/actions/pint.yml"><img src="https://github.com/Zen0x7/ServiceBench/actions/workflows/pint.yml/badge.svg" alt="Pint"></a>
<a href="https://github.com/Zen0x7/ServiceBench/actions/docker.yml"><img src="https://github.com/Zen0x7/ServiceBench/actions/workflows/docker.yml/badge.svg" alt="Docker"></a>
</p>

<p align="center">
<a href="https://codecov.io/gh/Zen0x7/ServiceBench"><img src="https://codecov.io/gh/Zen0x7/ServiceBench/graph/badge.svg?token=Z26I1PZTVN" alt="Coverage"></a>
</p>

<h2 align="center">About</h2>

> At this point, Service Bench doesn't have any objective or goal to reach. Is more like a scaffolding project than a self-hosted application. 
>
> Discussions about what it could be can be realized in issues
> 
> Software is released with no license. Components used by this project has been released in their respective licenses.
> 
> ¿What does it mean? 
>
> There are no freedom to use the code of this project at least a explicit license has been provided by author. 
> 
> In fact, there will be sanctions (economical and international) if you use portions of the code without an explicit license.
> 
> ¿This project will include a license in some future?
> 
> Yes, it could be a MIT, GNU license but at the moment there are no active discussion about that.
> 
> ¿Which grants will have the authors or contributors of the project?
> 
> If you want to contribute on this project, issues and pull requests are open to be received. Of course, the issue need to be first instead of a PR as is an author rights violation, so discussion will provide the specific case license. 

<h2 align="center">Requirements</h2>

```
php >= 8.3

Libraries:

    - pcntl
    - mysql
    - zip
    - sockets
    - bcmath
    - redis

mysql >= 5.7
node >= 20
```



<h2 align="center">Installation</h2>

```bash
git clone https://github.com/Zen0x7/ServiceBench.git
cd ServiceBench
composer install
yarn install
yarn build
php artisan migrate
```

<h2 align="center">Run</h2>

You'll need to run the following list of blocking processes:


```bash
- php artisan serve
- php artisan reverb:start
- php artisan horizon
```

<h2 align="center">Compose</h2>

```bash
docker compose up
```


