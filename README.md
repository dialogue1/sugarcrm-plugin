## dialogue1 amity SugarCRM integration ##

This SugarCRM plugin allows exporting customers from target lists to amity groups.

### Release notes
####1. Introduction

This document communicates the major new features that come with plugin. It also documents known problems.

####2. Pre installation
Files that will be overwritten by installing this module are:  
        - modules/ProspectLists/clients/base/views/recordlist/recordlist.js  
        - modules/ProspectLists/clients/base/views/recordlist/recordlist.php  
        - custom/Extension/modules/ProspectLists/Ext/Language/en_us.lang.php  
        - custom/Extension/modules/ProspectLists/Ext/Language/de_DE.lang.php  

New files that will be added by installing this module are:  
        - modules/dialogue1_amity/*  
        - custom/Extension/modules/dialogue1_amity/*  
        - custom/Extension/application/Ext/JSGroupings/amityCustomRoutes.php  
        - custom/javascript/amityCustomRoutes.js

####3. Installation
3.1 Upload zip file via module loader.  
3.2 Click on install next to the uploaded module.

####4. Post installation
4.1 'Quick Repair and Rebuild' in SugarCRM should be done.  
4.2 Refresh javascript cache in browser.

####5. Features
Exporting target lists from SugarCRM to amity. All contacts that have email should be synchronized with amity after 'Export to amity' is clicked for the specific list. All contacts are transferred to amity in the group that has the same name as target list in Sugar.

####6. Known limitations
If every step in post install procedure is not done, plugin will not work properly.

If list with the same name as the one being synchronized exists in your amity account, it will be deleted and the new one will be created.
