Static Data Module for Ionize CMS
=================================

## What does it do?

The module creates database tables containing records with static data,
the module furthermore adds models for data handling and tags for data rendering.


## Static Data

* Countries (ISO-3166-1) 
* Languages (ISO-639)


## Tags

Render <option> items from static data countries:
* Tag: <ion:staticdata:country_options/>  
* Attributes: 
    * lang - Label language, can be: CS, DE, EN, ES, FR, IT, NL. Default: EN  
    * selected - alpha2 code of country to be selected, Default: guessed from browser-language


## License

Released under [the MIT license](https://github.com/twbs/bootstrap/blob/master/LICENSE).    