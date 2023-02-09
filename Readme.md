# Shopware 6 Custom Header

| Version | Changes                                                                            | Availability   |
|---------|------------------------------------------------------------------------------------------ |----------------|
| 1.0.0   | First release                                                                         | Shopware Store         |
| 1.1.0   | Support for Shopware 6.2                                                                      | Shopware Store         |
| 1.2.0   | Bugfix that can cause icons to not be shown<br>Shopware 6.3 compatibility                   | Shopware Store         |
| 1.3.0   | new option 'open in new tab'<br>Bugfix: sales channel specific settings                   | Shopware Store         |
| 1.4.0   | Added snippet key support to the text and the link of the USPs                         | Github         |
| 1.5.0   | Moved icon selection to top of the configuration                          | Github         |
| 1.6.0   | Bugfix: Empty <span> element exists, when no icon is selected.<br>Added a new css class.                          | Github         |

# Installation

## Zip Installation package for the Shopware Plugin Manager

* Download the [latest plugin version](https://github.com/scope01-GmbH/ScopCustomHeader/releases/latest/) (
  e.g. `ScopCustomHeader-1.5.0.zip`)
* Upload and install plugin using Plugin Manager

## Git Version

* Checkout Plugin in `/custom/plugins/ScopCustomHeader`
* Install the Plugin with the Plugin Manager

# Configuration

To access the plugin configuration, go to the plugin manager inside the Shopware administration. There you can open the configuration of this plugin like this:

![configuration_access](screenshots/Access_Configuration.png)

Inside the configuration, you can first select the Sales Channel which you want to configure the plugin, or simply select "All Sales Channels".

![configuration_sales_channel](screenshots/Select_Sales_Channel.png)

After selecting your Sales Channel, you can customize the appearance of the header. Most of the options have a blue question mark on the right, which shows additional information if you hover over them.

The configuration is split into five different sections ([General](#general), [USP1, USP2, USP3](#usp1-usp2-and-usp3), [Mobile Version](#mobile-version)).

### General

In the "General" section you can enable/disable the custom header and customize the style of the header.

![configuration_general](screenshots/Configuration_General.png)

### USP1, USP2 and USP3

Here you can set the text that will be displayed on the left (USP1)/in the middle (USP2)/on the right (USP3) of the header. You can also select an image and define a link for this text.
If you want to use different texts and/or different urls for different languages, follow the instructions [here](#using-translations-in-the-usp-text-or-usp-link).

![configuration_usp](screenshots/Configuration_USP.png)

### Mobile Version

In this section you can modify the appearance of the header when it is displayed on mobile devices.

![configuration_mobile](screenshots/Configuration_Mobile.png)

## Using translations in the USP text or USP link
*(since v.1.4.0)*

When entering the text or the url of a USP, you can instead of using the untranslated text enter a snippet key. You can choose any snippet key, but it has to start with 'scopCustomHeader.'.

![configuration_snippet](screenshots/Configuration_Use_Snippet.png)

You can then define the translated text in the snippets using the snippet key you used in the plugin configuration.

![create_snippet](screenshots/Create_Snippet.png)
![list_snippets](screenshots/List_Snippets.png)
