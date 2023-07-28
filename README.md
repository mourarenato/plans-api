# Installation

Get started with Makefile:

1. Run `make fileMode`
2. Run `make install`
3. Make sure all containers is up and working

Get started without Makefile:

1. Run `git config core.fileMode false`
2. Give permissions in all project
3. Copy `docker-compose.example.yml` to `docker-compose.yml`
4. Run `docker-compose up -d`


# Project information

This project is a Rest API for processing json files and generate another json. Here neither framework is used, just pure PHP.

You can see the file that will be processed in `public/files` (`plans.json` and `prices.json)

A file called `proposta.json` will be generated after the request in `public/files`

# Using the project

#### Go to the Insomnia or Postman and run:

Endpoint(POST): http://10.10.0.22/index.php

Example of request:

    {
        "beneficiarios": 5,
        "idades": [17, 34, 19, 66, 44],
        "nomes": ["Jorge", "Ana", "Caio", "Amanda", "Luiz"],
        "registro": "reg2"
    }

The file is available in `public/files`