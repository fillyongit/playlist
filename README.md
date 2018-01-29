playlist
=========

A Symfony project created on July 14, 2017, 10:07 am.

Per il frontend uso react, bootstrap, jquery, tutti caricati come moduli nodejs grazie a webpack e babel. Per ricompilare i javascript e i css eseguire node_modules/.bin/webpack oppure lanciare la prima volta webpack --progress --watch oppure "npm run watch" (infatti ho aggiunto un paio di "script" in package.json.
Le librerie javascript e i css per adesso stanno sotto src/AppBundle/Resources/assets: bisognerebbe spostarle sotto app/Resources.

Il file js principale è main.js che appunto importa le varie librerie e viene usato come bundler webpack che genera il file bundle.js che è quello incluso nelle view html. Nel main.js sono anche caricati i file scss e vengono compilati anch'essi generando il file bundle.css.

Eseguire sempre webpack sotto nodemodules/.bin per ricompilare sia i js che gli scss.
Per fare in modo di non compilare continuamente si potrebbe far partire il task "watch": "webpack --progress --watch" presente nel package.json degli assets quando si fa partire il server di sviluppo di symfony (npm run watch).
Per fare questo ho creato un console command custom, sotto src/AppBundle/Command: chimarlo come server:runext.

Quando si fa "composer install" questo esegue lo script appAssetsInstall (vedere composer.json, post-command-install) che esegue npm install sotto la directory degli assets in modo da non doversi ricordare di farlo speratamente dopo aver fatto composer install.
 
