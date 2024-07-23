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


