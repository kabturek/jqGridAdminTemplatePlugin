[?php use_helper('I18N', 'Date') ?]
<script type="text/javascript">
jQuery(document).ready(function($){
  var colNames = [];
<?php foreach ($this->configuration->getValue('list.display') as $name => $field): ?>
<?php echo $this->addCredentialCondition(sprintf(<<<EOF
  colNames.push("%s"); 

EOF
, $field->getConfig('label')), $field->getConfig()); ?>
<?php endforeach; ?>

var colModel = [];
<?php foreach ($this->configuration->getValue('list.display') as $name => $field): ?>
<?php echo $this->addCredentialCondition(sprintf(<<<EOF
  colModel.push( {name: '%s', index:'%s'}); 

EOF
, $name, $name), $field->getConfig()); ?>
<?php endforeach; ?>

jQuery("#list").jqGrid({
  url:'[?php echo url_for("@<?php echo $this->getUrlForAction('list'); ?>"); ?]',
	datatype: "json",
  prmNames: {page:'page',rows:'rows', sort: 'sort', order: 'sort_type', search:'_search', nd:'nd', id:'id', oper:'oper', editoper:'edit', addoper:'add', deloper:'del', subgridid:'id', npage: null, totalrows:'totalrows'},
  colNames: colNames,
  colModel: colModel,
  rowNum:10,
  rowList:[10,20,30],
  pager: '#pager',
  sortname: 'id',
  viewrecords: true,
  sortorder: "desc"
});
jQuery("#list").jqGrid('navGrid','#pager',{edit:false,add:false,del:false});

});
</script>
[?php include_partial('<?php echo $this->getModuleName() ?>/assets') ?]

<div id="sf_admin_container">
  <h1>[?php echo <?php echo $this->getI18NString('list.title') ?> ?]</h1>

  [?php include_partial('<?php echo $this->getModuleName() ?>/flashes') ?]

  <table id="list"></table>
  <div id="pager"></div>
</div>
