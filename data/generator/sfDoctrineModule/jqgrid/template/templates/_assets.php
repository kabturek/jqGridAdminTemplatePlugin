<?php if (isset($this->params['css']) && ($this->params['css'] !== false)): ?> 
[?php use_stylesheet('<?php echo $this->params['css'] ?>', 'first') ?] 
<?php elseif(!isset($this->params['css'])): ?> 
[?php use_stylesheet('<?php echo sfConfig::get('sf_admin_module_web_dir').'/css/global.css' ?>', 'first') ?] 
[?php use_stylesheet('<?php echo sfConfig::get('sf_admin_module_web_dir').'/css/default.css' ?>', 'first') ?] 
<?php endif; ?>
[?php use_stylesheet("/jqGridAdminTemplatePlugin/css/ui.jqgrid.css", 'first') ?] 
[?php use_javascript("/jqGridAdminTemplatePlugin/js/i18n/grid.locale-en.js"); ?]
[?php use_javascript("/jqGridAdminTemplatePlugin/js/jquery.jqGrid.min.js"); ?]
