# Módulo Mprieto_Blog
### Instalación
#### Developer mode
```sh
$ php bin/magento module:enable Mprieto_Blog --clear-static-content
$ php bin/magento setup:upgrade
$ rm -rf var/di var/view_preprocessed var/cache generated/*
$ php bin/magento setup:static-content:deploy
```
#### Production mode
```sh
$ php bin/magento module:enable Mprieto_Blog --clear-static-content
$ php bin/magento setup:upgrade
$ php bin/magento setup:static-content:deploy
```
### Configuraciones
- Habilitar modulo MPRIETO -> [STOREVIEW] -> BLOG

### Personalizaciones Nativas
- n/a

### Funcionamiento
- Permite crear post por website 
- Los clientes pueden comentar el post

## Autor
- prieto.miguel0318@gmail.com 
[![N|Solid](https://media.licdn.com/dms/image/v2/D4E03AQGwpaYFKjlz0g/profile-displayphoto-scale_200_200/B4EZfQ5Zk_HgAY-/0/1751556398744?e=1761782400&v=beta&t=cwLwoa5hyNo7nb1WQ901GV_-OqPrHqUnl-cHWEE1n2g)](https://www.linkedin.com/in/mprieto0318/)
