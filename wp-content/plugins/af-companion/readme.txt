=== AF Companion ===
Contributors: afthemes
Tags: import, content, demo, data, widgets, customizer settings
Requires at least: 4.0
Tested up to: 5.7
Stable tag: 1.0.3
License: GPLv3 or later

Quickly import live demo content, widgets and settings with one click.

== Description ==

Import live demo content, widgets, and settings swiftly. This plugin gives fundamental layout to build your website & accelerate the development process.

This plugin will create a page in **AF Companion**.

If there are no prebuilt import files in the theme you are using, then you will be given three file upload inputs. The first one is mandatory, whereas the second and third one is optional.

In the first one , you need to upload demo content XML file for the genuine demo import.

In the second one, it asks you for WIE or JSON file to import widgets. You can create that file using [Widget Importer & Exporter](https://wordpress.org/plugins/widget-importer-exporter/) plugin.

In the third one, you can import the customizer settings, choose the DAT file that can be created from [Customizer Export/Import](https://wordpress.org/plugins/customizer-export-import/) plugin (the customizer settings will be imported only if the export file was created from the same theme).



== Installation ==

**From your WordPress dashboard**

1. Visit 'Plugins > Add New',
2. Search for 'AF Companion' and install the plugin.
3. Activate 'AF Companion' from your Plugins page.

Once the plugin is activated you will find the actual import page in **Appearance -> AF Companion.**

== Frequently Asked Questions ==

= I have activated the plugin. Where is the "AF Companion" page? =

You will find the import page in *wp-admin -> AF Companion*.

= Where are the demo import files and the log files saved? =

The files used in the demo import will be saved to the default WordPress uploads directory. An example of that directory would be: `../wp-content/uploads/2021/02/`.

The log file will also be registered in the *wp-admin -> Media* section, so you can access it easily.

= I can't activate the plugin, because of a fatal error, what can I do? =

*Update: There is now a admin error notice, stating that the minimal PHP version required for this plugin is 5.3.2.*

You want to activate the plugin, but this error shows up:

*Plugin could not be activated because it triggered a fatal error*

This happens, because your hosting server is using a very old version of PHP. This plugin requires PHP version of at least **5.3.x**, but we recommend version *5.6.x*. Please contact your hosting company and ask them to update the PHP version for your site.


== License ==

AF Companion uses 'One Click Demo Import' plugin script
https://github.com/proteusthemes/one-click-demo-import
(C) 2016 ProteusThemes.com
Licensed under the GNU General Public License v2.0,
http://www.gnu.org/licenses/gpl-2.0.html

AF Companion uses 'Wordpress Importer' plugin script
https://github.com/humanmade/WordPress-Importer
(C) 2016 @humanmade
Licensed under the GNU General Public License v2.0,
http://www.gnu.org/licenses/gpl-2.0.html


== Copyright ==

AF Companion, Copyright 2021 AF themes

AF Companion is distributed under the terms of the GNU GPL

This program is free software; you can raftcstribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation; either version 2 of the License, or
(at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License along
with this program; if not, write to the Free Software Foundation, Inc.,
51 Franklin Street, Fifth Floor, Boston, MA 02110-1301 USA.


== Changelog ==

### 1.0.3 - 19/04/2021

Changes:
*Update - WP 5.7 Compatibility Check*

### 1.0.2 - 19/04/2021

Changes:
*Fixed - Import Success Message*

### 1.0.1 - 18/04/2021

Changes:
*Fixed - Undefined Pro Link*

### 1.0.0 - 16/02/2021

Changes:
*Initial ReleaseE*
