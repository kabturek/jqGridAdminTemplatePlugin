[?php use_helper('I18N', 'Date') ?]
<script type="text/javascript">
jQuery(document).ready(function($){
  var colNames = [];
<?php if ($this->configuration->getValue('list.batch_actions')): ?>
          colNames.push(' ');
<?php endif; ?>
<?php foreach ($this->configuration->getValue('list.display') as $name => $field): ?>
<?php echo $this->addCredentialCondition(sprintf(<<<EOF
  colNames.push("%s"); 

EOF
, $field->getConfig('label')), $field->getConfig()); ?>
<?php endforeach; ?>
<?php if ($this->configuration->getValue('list.object_actions')): ?>
          colNames.push('[?php echo __('Actions', array(), 'sf_admin') ?]');
<?php endif; ?>

var colModel = [];
<?php if ($this->configuration->getValue('list.batch_actions')): ?>
          colModel.push( {name: 'batch', sortable : false, search: false, width: 30});
<?php endif; ?>
<?php foreach ($this->configuration->getValue('list.display') as $name => $field): ?>
<?php echo $this->addCredentialCondition(sprintf(<<<EOF
  colModel.push( {name: '%s', index:'%s' , width: %s, sortable: %s, search: %s}); 

EOF
, $name, $name, $field->getConfig('width', 120), $field->getConfig('sortable', true), $field->getConfig('search', true) ), $field->getConfig()); ?>
<?php endforeach; ?>
<?php if ($this->configuration->getValue('list.object_actions')): ?>
          colModel.push( {name: 'actions', sortable : false, search: false});
<?php endif; ?>

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

<?php if ($this->configuration->getValue('list.batch_actions')): ?>
    <form action="[?php echo url_for('<?php echo $this->getUrlForAction('collection') ?>', array('action' => 'batch')) ?]" method="post">
<?php endif; ?>
  <table id="list"></table>
  <div id="pager"></div>
  <div id="sf_admin_content">
    <ul class="sf_admin_actions">
      [?php include_partial('<?php echo $this->getModuleName() ?>/list_batch_actions', array('helper' => $helper)) ?]
      [?php include_partial('<?php echo $this->getModuleName() ?>/list_actions', array('helper' => $helper)) ?]
    </ul>
<?php if ($this->configuration->getValue('list.batch_actions')): ?>
    </form>
<?php endif; ?>
  </div>
</div>
