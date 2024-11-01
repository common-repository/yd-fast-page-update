=== YD *FAST* Page update ===
Contributors: ydubois
Donate link: http://www.yann.com/en/wp-plugins/yd-fast-page-update
Tags: Wordpress, plugin, CMS, admin, administration, blogs, blog, page, pages, plugins, manage, management, slow, fast, update, save, French, English, custom, permalinks, permalink, url, urls, rewrite, rewrites, pretty, updating, SEO, database, load, optimization, optimize, rewriterule, rewriterules, rewrite-rule, rewrite-rules, accelerator, acceleration, accelerate, speed-up, speed, flush, flushing
Requires at least: 2.9.1
Tested up to: 2.9.2
Stable tag: trunk

Speed-up page updating, when using custom permalinks and a lot of pages.

== Description ==

= Drastically reduce page updating time! =

This Wordpress plugin **optimizes page management routines**, it accelerates page saving time by bypassing the very heavy process of rebuilding all the rewriterules of your pretty-permalink enabled blogs each time anything on a page is changed.

When using Wordpress as a CMS, it is not unusual to deal with web sites that have a lot of hierarchical pages. 
When reaching a few hundred pages and using custom or pretty SEO-aware permalinks, page updates become **VERY** slow. 

Eventually, when reaching about 1000 pages, page management becomes quite tedious and time-consuming, because any change in a page takes a few minutes to be saved (during which the site usually comes to a halt because of heavy database load and table lock)
when script or database max request times are finally reached, it becomes impossible to modify anything in a page.

The reason is that **rewrite rules for *all* the blog's pages are rebuilt everytime something is changed and saved in a page**, even if the url structure has no reason to change at all.

(This is an aknowledged weakness of Wordpress, that has been featured on the TRAC development list for a few years already)

This very short and simple plugin tries to fix this problem for most page updates: 
Rewriterules structure will get rebuilt only if the name of the page, or its parent attachment are changed, resulting in tremendous acceleration of the whole updating process.

Since version 0.2.0 you can decide for yourself when to force flushing of page address rewriterules, or when to completely disable rules flushing.
Please take notice that if you disable the rules flushing, your new page addresses will not work until you force a bulk rules flush.

Expect hundred-fold improvement in page update delay in the admin for a 1000+ pages blog.
(from over a minute to less than 10 seconds on one of my 2000+ page blog)

By further [patching your wp-includes/post.php core file](http://core.trac.wordpress.org/attachment/ticket/10852/10852_get_page_children.diff) 
according to [WP trac Ticket #10852](http://core.trac.wordpress.org/ticket/10852), you will possibly get even better performances.

*(btw. I have another improvement of wp-includes/post.php that I could not yet figure out how to build into a plugin that makes me gain a few more seconds on each save.)*

= Possible caveat =

This plugin chooses to bypass an important core function of the Wordpress administration workflow for the sake of speed.
Be aware that on some specific environments, this could cause unwanted side-effects, such as bad page linking or url permalink structure.

The plugin has however been tested on a 2000+ page medium-loaded site (around 1000 visitors/day) with 50 popular plugins installed and works perfectly for that purpose.

Your own mileage may vary.

= Active support =

Drop me a line on my [YD FAST page update support site](http://www.yann.com/en/wp-plugins/yd-fast-page-update "Yann Dubois' FAST page update plugin for Wordpress") to report bugs or successful implementations, ask for a specific feature or improvement, or just tell me how you're using the plugin.

= Description en Français : =

Ce plug-in Wordpress accélère d'un facteur 100 ou plus le temps de sauvegarde ou mise à jour des pages hiérarchiques d'un blog Wordpress comprenant un très grand nombre de pages (plusieurs centaines).

En effet, dès qu'on atteint quelques centaines de pages sur un blog orienté CMS, si on utilise des url "propres" compatibles avec l'optimisation du référencement (SEO), le temps de mise à jour des pages commence à prendre plusieurs minutes.
L'administration des pages devient finalement impossible à cause d'une surcharge de la base de données ou de délais d'exécution trop importants.

Ce plugin règle le problème en évitant de reconstruire toute la structure des liens de toutes les pages du site si le nom de la page ou sa page de rattachement hiérarchique n'ont pas changé.

Le plugin peut fonctionner avec n'importe quelle langue ou jeu de caractères compatible avec Wordpress.

Pour toute aide ou information en français, laissez-moi un commentaire sur le [site de support du plugin YD FAST page update](http://www.yann.com/en/wp-plugins/yd-fast-page-update "Yann Dubois' FAST page update plugin for Wordpress").

= Funding Credits =

Original development of this plugin has been paid for by [Nogent Citoyen](http://www.nogent-citoyen.fr "Nogent Citoyen"). Please visit their site!

Le développement d'origine de ce plugin a été financé par [Nogent Citoyen](http://www.nogent-citoyen.com "Nogent Citoyen"). Allez visiter leur site !

= Translation =

If you want to contribute to a translation of this plugin's documentation, please drop me a line by e-mail or leave a comment on the plugin's page.

== Installation ==

1. Unzip yd-fast-page-update.zip
1. Upload the `yd-fast-page-update` directory and all its contents into the `/wp-content/plugins/` directory of your WP site
1. Activate the plugin through the 'Plugins' menu in WordPress

For specific installations, some more information might be found on the [FAST Page Update plugin support page](http://www.yann.com/en/wp-plugins/yd-fast-page-update "Yann Dubois' Fast page update plugin for Wordpress")

== Frequently Asked Questions ==

= Where should I ask questions? =

http://www.yann.com/en/wp-plugins/yd-fast-page-update

Use comments.

I will answer only on that page so that all users can benefit from the answer. 
So please come back to see the answer or subscribe to that page's post comments.

= Puis-je poser des questions et avoir des docs en français ? =

Oui, l'auteur est français.
("but alors... you are French?")

== Screenshots ==

1. TODO

== Revisions ==

* 0.1.0 Original beta version.
* 0.2.0 Added manual rules flush control.

== Changelog ==

= 0.1.0 =
* Initial release
= 0.2.0 =
* Added manual rules flush control panel

== Upgrade Notice ==

= 0.1.0 =
Initial release.
No special issue. Install or upgrade the usual WP way. See changelog for details.
= 0.2.0 =
Feature upgrade.
No special issue. Install or upgrade the usual WP way. See changelog for details.

== To Do ==

Test. Final release.

== Did you like it? ==

Drop me a line on http://www.yann.com/en/wp-plugins/yd-fast-page-update

And... *please* rate this plugin --&gt;