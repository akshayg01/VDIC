<?php
	global $pageObject;
		
	if(!isset($pageObject) || !array_key_exists("custom1",$tabparams))
		return;
	
	$arrTabs = array();
	
	// get data source table name
	if($pageObject->tName)
		$table = $pageObject->tName;
	else
		$table = $strTableName;
	
	// get short table name
	if($pageObject->shortTableName)
		$shortTableName = $pageObject->shortTableName;
	else
		$shortTableName = $pageObject->pSet->getShortTableName();
	
	// get tabs arr in accordance with page type
	if($pageObject->pageType == PAGE_EDIT)
		$arrTabs = $pageObject->arrEditTabs;
	elseif($pageObject->pageType == PAGE_ADD)
		$arrTabs = $pageObject->arrAddTabs;
	elseif($pageObject->pageType == PAGE_VIEW)
		$arrTabs = $pageObject->arrViewTabs;
	
	$tabGroupId = 0;
	$tabType = 0;
	for($i=0;$i<count($arrTabs);$i++)
	{
		if($arrTabs[$i]['tabId']==$tabparams["custom1"])
		{
			$tabGroupId = $arrTabs[$i]['tabGroup'];
			$tabType = $arrTabs[$i]['nType'];
			break;
		}
	}
	if(!$tabGroupId && !$tabType)
		return;
	
	$rtl = $xt->getReadingOrder() == 'RTL' ? 'RTL' : '';
	
	//show section
	if($tabType)
	{
		if ($arrTabs[$i]['expandSec']){
			$src = 'images/minus.gif';
			$hiddenStyle = '';
		}else{
			$src = 'images/plus.gif';
			$hiddenStyle = 'style="display: none;"';
		}
		$cssStyle = '';
		$layout = GetPageLayout($shortTableName, $pageObject->pageType, $arrTabs[$i]['tabId']);
		if($layout)
		{
			$cssStyle = ' '.$layout->style." page-".$layout->name;
			$pageObject->AddCSSIEFile("styles/".$layout->style.'/style'.$rtl.".css");
			$pageObject->AddCSSFile("pagestyles/".$layout->name.$rtl.".css");
		}
		echo '<img id="section_'.$arrTabs[$i]['tabId'].'Butt" border="0" src="'.$src.'" valign="middle" alt="*" /> 
			  '.$arrTabs[$i]['tabName'].'<br>
				<div id="section_'.$arrTabs[$i]['tabId'].'" class="sectionFrame runner-pagewrapper'.$cssStyle.'" '.$hiddenStyle.' >';
		$xt->display($shortTableName."_".$pageObject->pageType."_".$arrTabs[$i]['tabId'].".htm");
		echo '</div>';
	}
	else{
			//show tab group
			?>
			<div id="tabGroup_<?php echo $tabparams["custom1"]?>" class="yui-navset">
				<ul class="yui-nav">
				<?php 
					$countTabs = 0;
					for($i=0;$i<count($arrTabs);$i++)
						if($arrTabs[$i]['tabGroup']==$tabGroupId)
						{
							echo '<li class="runner-tab'.(++$countTabs==1 ? ' selected' : '').'">';
							echo '<span class="runner-tableft"></span><span class="runner-tabright"></span>
							<a href="#'.$arrTabs[$i]['tabId'].'"><span>'.$arrTabs[$i]['tabName'].'</span></a></li>';
						}
				?>
				</ul>
				<div class="yui-content runner-cc">
					<?php
						for($i=0;$i<count($arrTabs);$i++)
							if($arrTabs[$i]['tabGroup']==$tabGroupId)
							{
								$cssStyle = '';
								$layout = GetPageLayout($shortTableName, $pageObject->pageType, $arrTabs[$i]['tabId']);
								if($layout)
								{
									$cssStyle = ' '.$layout->style." page-".$layout->name;
									$pageObject->AddCSSIEFile("styles/".$layout->style.'/style'.$rtl.".css");
									$pageObject->AddCSSFile("pagestyles/".$layout->name.$rtl.".css");
								}
								echo '<div id="'.$arrTabs[$i]['tabId'].'" class="runner-pagewrapper'.$cssStyle.'">';
								$xt->display($shortTableName."_".$pageObject->pageType."_".$arrTabs[$i]['tabId'].".htm");
								echo "</div>";
							}
					?>
				</div>
			</div>
			<?php
		}
?>