**GPT by JP - a simple PHP framework for a simple ChatGPT bot**
-
This is a simple procedural framework for you to deploy your own ChatGPT bot 
both locally and to your own domain. This project is purely for demonstration purposes and 
to help new developers understand how an OpenAI integration can work in PHP (via `curl`) using Docker.

The bot is driven by an initial prompt, which you can set in the `/includes/prompt.php` file. 

For the purposes of this project, I am using the `gpt-4` model. This can also be updated in the `/includes/prompt.php` file.

**Prerequisites**
-
- An OpenAI key
- - https://platform.openai.com/account/api-keys
- Docker desktop (for development and local deployment) 
- - https://www.docker.com/products/docker-desktop/
- A DigitalOcean account (for production and deployment to a custom domain) 
- - https://m.do.co/c/0d7925eba36e (this is my DO referral link)


**Instructions to deploy locally**
-
- Clone the project
- Edit `/gptbyjp/dev/update_and_rename_to.env` and add your `OPENAI_API_KEY`
- From CLI, navigate to `/gptbyjp/dev`
- From CLI: `docker-compose up --build -d`

*The Dockerfile in `/dev` uses volumes, so you can edit the code in `/source` without rebuilding.*


**Instructions to deploy to a custom domain**
-
- Create a new project on DigitalOcean or rename the default project
- Create a new "app" (under the `create` menu button)
- Under "Create Resource From Source Code", choose `GitHub`
- Edit your GitHub permissions to allow access to your cloned repository
- Choose your cloned repo (which DigitalOcean now has access to)
- Enable `autodeploy` and click `Next`
- Edit the app and change the `HTTP` port from `8080` to `80`, then click `Save` -> `Back` -> `Next`
- Edit `Global` environment variables and add your `OPENAI_API_KEY` (in dev, you did this via the .env), then click `Next`
- Edit the `App Info` to change the name if desired, then click `Next`
- Edit the `Plan` under `Billing` according to your needs (`Basic` works fine)
- Click `Create Resources` and wait for the build to complete
- Once deployed, go to the `Settings` tab and add your domain under `Domains`
- - It is strongly recommended to allow DigitalOcean to manage the domain, and you just set the nameservers to ns1.digitalocean.com, ns2., etc. 

And that's it, you now have a local development environment and a production environment for a custom ChatGPT bot.

You can make changes in development and when you're happy, push the changes to your clone, and it will 
automatically redeploy on DigitalOcean.

When you push your changes to GitHub, be sure *not* to include the .env file and expose your API key. 
You might even exclude the entire `/dev` folder and set your cloned repo to `private`.

**Some technical notes**
-
**php.ini differences in dev and prod**
- Error reporting is disabled in prod
- `phpinfo()` is disabled in prod
- `short_open_tags` is `On` in both prod and dev. I use this to easily add variables and constants into the template files. 
You can disable it but be sure to update the files in `/templates`


If you're going to build on this framework, you could (and probably should) have a `dev_source` and a `prod_source`, 
in that case just update the Dockerfiles to `COPY` the right source folder, and update the `docker-compose.yml` in 
`/dev` to mount the correct source to the volume. 

For simplicity, I recommend keeping the production `Dockerfile` and `docker-compose.yml` in the 
project's root directory if you're using DigitalOcean and GitHub.

You can handle deployment from CLI if you don't want to use the DigitalOcean web interface, for example you could use `doctl`,
just build an `app.yaml` in the project directory with the relevant app scope, and use `doctl apps create --spec app.yaml --access-token YOUR_TOKEN`
to build and deploy. Your `app.yaml` should include `deploy_on_push: true` under `github` and `http_port: 80`

If I get some positive feedback on this, I will be happy to do another version with Laravel and MySQL (storing prompt history, assigning to users, etc.).

**License**
-
MIT License

Copyright (c) 2023 Julian Parge

Permission is hereby granted, free of charge, to any person obtaining a copy
of this software and associated documentation files (the "Software"), to deal
in the Software without restriction, including without limitation the rights
to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
copies of the Software, and to permit persons to whom the Software is
furnished to do so, subject to the following conditions:

The above copyright notice and this permission notice shall be included in all
copies or substantial portions of the Software.

THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE
SOFTWARE.

**Contact**
-
You can reach me via [julian@parge.org](mailto:julian@parge.org)