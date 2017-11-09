# Lab Environment

The lab environment enables the developer to run the full DigitalState architecture on a local machine as a dockerized application.

It also provides useful developer shortcuts to help manage multiple containers at once.

## Installation

1. To begin, you will need to install Docker (for [Windows](https://www.docker.com/docker-windows) / for [Mac](https://docs.docker.com/docker-for-mac) / for [Linux](https://docs.docker.com/engine/installation/#server)) on your local machine.

2. Download this repository.

3. Open a console and make it point to the root of the repository directory:

   ```
   cd /home/demo/sdk
   ```

4. Boot the SDK container:

   ```
   docker-compose up -d
   ```

5. Confirm the container has been booted successfully:

   ```
   docker ps
   ```
   
   You should see the following output:
   
   ```
   CONTAINER ID        IMAGE               COMMAND             CREATED             STATUS              PORTS               NAMES
   4ceab8511b85        sdk_sdk             "/bin/sh"           3 seconds ago       Up 2 seconds                            sdk
   ```

6. Enter the container in console mode:

   ```
   docker exec -it sdk /bin/sh
   ```

7. Point to the lab environment directory:

    ```
    cd /etc/ansible/env/lab
    ```

At this point, you have the SDK container running locally as a bare Linux Alpine system with Ansible pre-installed and ready to accept commands. 

## Configuration

The lab environment makes use of an Ansible inventory file found [here](/sdk/ansible/env/lab/inventory.yml) to describe the host server, general configurations and each enabled microservices.

For the lab environment, the host server is configured to localhost. In other words, when you will run Ansible commands, they will run against itself inside the container.

<pre>
...
    hosts:
        server:
            ansible_connection: <b>local</b>
...
</pre>

Afterwards, you will find general configurations.

<pre>
...
        jwt_private_key: <b>/root/resource/security/jwt/lab/key</b>
        jwt_public_key: <b>/root/resource/security/jwt/lab/key.pub</b>
        jwt_key_pass_phrase: <b>~</b>

        fixtures: <b>dev</b>
...
</pre>

Finally, you will find the list of each microservices.

<pre>
...
        authentication: <b>enabled</b> # ~ to disable
        authentication_version: <b>develop</b> # The branch name
        authentication_host: <b>api.authentication.ds</b> # The host name
...
</pre>

## Commands

Below is the full list of available commands:

- [Deploy](deploy.md)
- System
    - [Setup](system/setup.md)
- Repository
    - [Download](repository/download.md)
    - [Override](repository/override.md)
- JWT
    - [Download](jwt/download.md)
    - [Configure](jwt/download.md)
- Proxy
    - Container
        - [Up](proxy/container/up.md)
        - [Down](proxy/container/down.md)
        - [Stop](proxy/container/stop.md)
- Container
    - Env
        - [Configure](container/env/configure.md)
    - [Up](container/up.md)
    - [Down](container/down.md)
    - [Stop](container/stop.md)
