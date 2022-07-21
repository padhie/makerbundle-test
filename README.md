# RUN
`docker compose run php bash`


# XDEBUG
Change xdebug settings to use it!

File: `/etc/php/8.1/mods-available/generated_conf.ini`
Content:
```text
xdebug.client_host = 169.254.83.143
xdebug.mode = debug
xdebug.idekey = PHPSTORM
xdebug.log = "/application/logs/xdebug.log"
```