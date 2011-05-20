<?php /* Smarty version Smarty-3.0.7, created on 2011-05-20 23:09:23
         compiled from "/afs/ms.mff.cuni.cz/u/b/babickap/PHP/bab/lib/../example//index/templates/templates/error.tpl" */ ?>
<?php /*%%SmartyHeaderCode:860747394dd6d88358b9d8-18009312%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'abab80d09d81305bd24e43c3be827fd6e744bd2a' => 
    array (
      0 => '/afs/ms.mff.cuni.cz/u/b/babickap/PHP/bab/lib/../example//index/templates/templates/error.tpl',
      1 => 1305054181,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '860747394dd6d88358b9d8-18009312',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=<?php echo $_smarty_tpl->getVariable('charset')->value;?>
"/> 
	<title><?php echo $_smarty_tpl->getVariable('title')->value;?>
</title>
</head>
<body>
<div id="error">
	<span><b><?php echo $_smarty_tpl->getVariable('error')->value[0];?>
</b> [errno. <?php echo $_smarty_tpl->getVariable('error')->value[1];?>
]</span>
</div>
</body>
</html>
