<?php
	include_once("db_config.php");
	include("include/session_timer.php");
 ?>
 <?php
 	$data_id = $_REQUEST['idx'];

 	$query= "SELECT * FROM wow_specifictable WHERE s_id='$data_id'";  //desc 내림차순   ASC 오름차순
 	$result= $mysqli->query($query);
 	$data = mysqli_fetch_array($result);
	$beforestitle = $data['product_s_title'];
  $beforetext = $data['product_s_text'];
	$query2 = "SELECT * FROM wow_subtable WHERE no = '$data_id'";
	$result2 = $mysqli->query($query2);
	$data2 = mysqli_fetch_array($result2);
	$beforetitle = $data2['product_name']
 ?>

<html>
<head>
<meta http-equiv="Content-type" content="text/html; charset=UTF-8" />
<link type="text/css" href="../lib/m_style.css" rel='stylesheet' />
<title>WoW System</title>

<script type="text/javascript" src="js/HuskyEZCreator.js" charset="utf-8"></script>
</head>
<body>
<TABLE BORDER='0' CELLSPACING='0' CELLPADDING='0' WIDTH='100%' HEIGHT='100%' ALIGN='CENTER' VALIGN='TOP'>
<TR>
<TD WIDTH='100%'  HEIGHT='70'  ALIGN='LEFT'  VALIGN='MIDDLE' BGCOLOR='#E89C05'>
<table border='0' width='90%' height='70' bgcolor='#E89C05' align='center' cellspacing='0' cellpadding='0'>
	</table>
</TD>

<TR>
<TD WIDTH='100%'  HEIGHT='100%'  ALIGN='CENTER'  VALIGN='TOP'>
<table border='0' width='75%' height='100%' bgcolor='FFFFF' align='center' cellspacing='0' cellpadding='0'>
<tr>
    <td width='100%' height='10' colspan='2' bgcolor='FFFFF'>&nbsp;</td>
<tr>
    <td width='100%' height='30' colspan='2' bgcolor='FFFFF' align='center'> <?php echo "<b>".$beforetitle."</b> 항목에 대한 정보를 수정합니다." ?> </td>


<form name='write' action='edit_post.php?idx=<?=$data_id?>' method='post' enctype='multipart/form-data'>
<tr>
<td width='20%' height='30'  align='right' valign='middle'>

<tr>
<td width='20%' height='30'  align='right' valign='middle'>
<li>항목 제목</td>
<td width='80%' height='30' bgcolor='FFFFF' align='left' valign='middle'>
&nbsp;<input type='text' name='subject' style="width:500px; height:30px;" value = '<?=$beforestitle?>'>
</td>

<tr>
<td width='100%' height='420'  align='center' valign='middle' colspan='2'>
 <textarea id='ir1' name='story' style="width:886px; height:400px;" >
 	<?=nl2br($beforetext)?>
 </textarea>
</td>

<script type="text/javascript">
var oEditors = [];
nhn.husky.EZCreator.createInIFrame({
	oAppRef: oEditors,
	elPlaceHolder: "ir1",
	sSkinURI: "SmartEditor2Skin.html",
	fCreator: "createSEditor2"
});

function submitContents(elClickedObj) {
	oEditors.getById["ir1"].exec("UPDATE_CONTENTS_FIELD", []);	// 에디터의 내용이 textarea에 적용됩니다.

	// 에디터의 내용에 대한 값 검증은 이곳에서 document.getElementById("ir1").value를 이용해서 처리하면 됩니다.

	try {
		elClickedObj.form.submit();
	} catch(e) {}
}

</script>

<tr>
<td width='100%' height='30'  align='center' valign='middle' colspan='2'>
</td>
<tr>
<td width='100%' height='30' bgcolor='EDEDED' colspan='2' align='center' valign='middle'>
<input type='Submit' value='전송' onclick='submitContents()'>
</td>
</form>
<tr>
    <td width='100%' height='100%' colspan='2'  bgcolor='FFFFF'>&nbsp;</td>
</tr>
</table>
</TD>

<TR>
<TD WIDTH='100%'  HEIGHT='100%'  ALIGN='CENTER'  VALIGN='TOP'>&nbsp;</TD>
</TR>
</TABLE>

</body>
</html>
