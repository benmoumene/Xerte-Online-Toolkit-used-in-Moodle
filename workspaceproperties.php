<?php

require_once(dirname(__FILE__) . "/config.php");
_load_language_file("/workspaceproperties.inc");

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
<title><?PHP echo WORKSPACE_PROPERTIES_TITLE; ?></title>

<!--

University of Nottingham Xerte Online Toolkits

Workspace properties HTML page
Version 1.0

-->

<link href="website_code/styles/workspacemanagement_tab.css" media="screen" type="text/css" rel="stylesheet" />
<link href="website_code/styles/properties_tab.css" media="screen" type="text/css" rel="stylesheet" />
<link href="website_code/styles/folderproperties_tab.css" media="screen" type="text/css" rel="stylesheet" />
<link href="website_code/styles/frontpage.css" media="screen" type="text/css" rel="stylesheet" />
<link href="website_code/styles/xerte_buttons.css" media="screen" type="text/css" rel="stylesheet" />

<?php
_include_javascript_file("website_code/scripts/template_management.js");
_include_javascript_file("website_code/scripts/properties_tab.js");
?>
<script type="text/javascript" language="javascript" src="website_code/scripts/validation.js"></script>
<?php
_include_javascript_file("website_code/scripts/workspaceproperties_tab.js");
_include_javascript_file("website_code/scripts/ajax_management.js");
_include_javascript_file("website_code/scripts/import.js");
?>

</head>

<!--

Start the page and once loaded set the default option

-->

<body onload="tab_highlight('1');my_properties_template()">

<!--

Hidden Iframe to allow for ajax file uploads

-->

<iframe id="upload_iframe" name="upload_iframe" src="" style="width:0px;height:0px; display:none"></iframe>


<div class="properties_main">
            <div class="main_area">
                <div>
                    <span id="title">
                        <img src="website_code/images/folder_workspace.gif" style="vertical-align:middle; padding-left:10px;" />
                        <?PHP echo WORKSPACE_PROPERTIES_DISPLAY_TITLE; ?>
                    </span>
                </div>
                <div id="data_area">

                        <!--

                            Dynamic area is the DIV used by the AJAX queries (The right hand side area of the properties panel.

                        -->

                        <div id="dynamic_area">
                        </div>

                        <!--

                            Set up the three menu tabs

                            Structure

                            tab1-1 is the small part to the right of the main tab, this is used to deal with the border round the main section
                            tab1 is the actual tab with the text in it

                        -->

                        <div id="menu_tabs">
                            <div class="tab_spacer" style="height:35px;">
                            </div>
                            <div id="tab1-1" class="tab_right_pad" style="height:38px;">
                            </div>
                            <div id="tab1" class="tab" style="width:146px; height:38px;">
                                <p onclick="javascript:tab_highlight('1');my_properties_template()">
                                    <?PHP echo WORKSPACE_PROPERTIES_TAB_DETAILS; ?>
                                </p>
                            </div>
                            <div class="tab_spacer">
                            </div>
                            <div id="tab2-1" class="tab_right_pad" style="height:38px;">
                            </div>
                            <div id="tab2" class="tab" style="width:146px; height:38px;">
                                <p onclick="javascript:tab_highlight('2'); workspace_templates_template()">
                                    <?PHP echo WORKSPACE_PROPERTIES_TAB_PROJECTS; ?>
                                </p>
                            </div>
                            <div class="tab_spacer">
                            </div>
                            <div id="tab3-1" class="tab_right_pad" style="height:38px;">
                            </div>
                            <div id="tab3" class="tab" style="width:146px; height:38px;">
                                <p onclick="javascript:tab_highlight('3'); folder_rss_templates_template()">
                                    <?PHP echo WORKSPACE_PROPERTIES_TAB_FEEDS; ?>
                                </p>
                            </div>
                            <div class="tab_spacer">
                            </div>
                            <div id="tab4-1" class="tab_right_pad" style="height:38px;">
                            </div>
                            <div id="tab4" class="tab" style="width:146px; height:38px;">
                                <p onclick="javascript:tab_highlight('4');import_templates_template()">
                                    <?PHP echo WORKSPACE_PROPERTIES_TAB_IMPORT; ?>
                                </p>
                            </div>
                            <div class="tab_spacer">
                            </div>
                            <div id="tab5-1" class="tab_right_pad" style="height:38px;">
                            </div>
                            <div id="tab5" class="tab" style="width:146px; height:38px;">
                                <p onclick="javascript:tab_highlight('5');api_template()">
                                    <?PHP echo WORKSPACE_PROPERTIES_TAB_API; ?>
                                </p>
                            </div>
                            <div class="tab_spacer">
                            </div>
                            <!--

                                Last spacer given sufficient heigbt to fill the rest of the border for the right hand panel

                            -->

                            <div class="tab_spacer" style="height:275px;">
                            </div>
                        </div>
                </div>
		<div style="clear:both;"></div>
            </div>
		<div style="clear:both;"></div>					
</div>

</body>
</html>
