playlist
=========

A Symfony project created on July 14, 2017, 10:07 am.

Per il frontend uso react, bootstrap, jquery, tutti caricati come moduli nodejs grazie a webpack e babel.
Le librerie javascript e i css stanno sotto src/AppBundle/Resources/assets/js[css]/
Il file js principale è main.js che appunto importa le varie librerie e viene usato come bundler webpack che genera il file bundle.js che è quello incluso nelle view html.

Eseguire sempre webpack sotto nodemodules/.bin per ricompilare sia i js che gli scss.
