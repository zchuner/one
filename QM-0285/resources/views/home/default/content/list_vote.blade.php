<?php
/**
 * Created by PhpStorm.
 * User: Rouyi
 * Date: 2017/10/7
 * Time: 20:32
 * Desc: 文章栏目模板
 */
include getTemplate('header');
?>

<div class="container content news">
    <div class="row">
        <div class="col-md-8 left">
            <div class="imagesTop">
                <h2 class="hr-title small">{$CAT['catname']} <!--a class="fr more"><i class="fa fa-refresh"></i>换一换</a--></h2>
                {qm:content action="lists" catid="$CAT['catid']" num="1"}
                <div class="items">
                    {qm:content action="lists" catid="$catid" num="21" order="id DESC" page="$page"}
                    <ul class="row"><!--新增class row-->
                        {loop $data $r}
                        <li class=" mt-5-new col-md-6 col-sm-6 col-xs-12 voteli"><!--新增mt-5-new voteli    原有row-->
                            <div class=" image"> <!--原来col-xs-3     改col-md-3 col-sm-3 col-xs-4 -->
                                <a href="{$r['url']}"><img src="<?php echo ($r['thumb']) ?  $r['thumb'] : asset('admin/extends/images/nopic.gif')?>" alt="{$r['title']}"></a><!--src="{$r['thumb']}"-->
                            </div>
                            <div class="info"> <!--原来col-xs-9     改col-md-9 col-sm-9 col-xs-8  新增row-->
                                <p class="title"><a href="{$r['url']}" title="{$r['title']}">{$r['title']}</a></p>
                                <p class="description"><a href="{$r['url']}">{$r['description']}</a></p> <!--原来{$r['description']}   {str_cut($r['description'], 120, '...')}-->
                                <div class="data ">
                                	<!--<p class="col-md-2 col-sm-2 col-xs-4 view"><i class="fa fa-eye"></i>{getViewNumber($r['id'], $r['catid'])}</p>
                                    <p class="col-md-3 col-sm-3 col-xs-8 comment" style=""><i class="fa fa-clock-o"></i>{date('Y-m-d', $r['inputtime'])}</p>-->
                                    <p class=" comment" style=""><i class="fa fa-thumbs-o-up"></i>喜欢就进去点个赞吧：<?php echo getPraiseNumber($r['id'], $r['catid'])?></p>
                                    <p class=" fav praise-btn" data-id="<?php echo $id?>" data-cid="<?php echo $catid?>"><i style="display:inline-block;height:16px;background:#0FF;width:<?php echo getPraiseNumber($r['id'], $r['catid'])*5?>px;"></i></p><!--原来{getPraiseNumber($r['id'], $r['catid'])}-->
                                    
                                    <!--原来 比例 2 2 8  新增style="text-align:right;"-->
                                    <!--<p class="col-xs-4 comment" style=""><i class="">喜欢就点赞奥</i><i style="display:inline-block;height:20px;background:#0FF;width:<?php echo getPraiseNumber($r['id'], $r['catid'])?>px;"></i></p>-->
                                </div>
                            </div>
                        </li>
                        {/loop}
                    </ul>
                    <?php if ($pages) : ?>
                    <div class="clear pages"><!--原有clear -->
                        <?php echo $pages?>
                    </div>
                    <?php endif; ?>
                    {/qm}
                </div>   
                
            </div>
        </div>
        <?php include getTemplate('list_right');?>
    </div>
</div>
<!--新增-->
<script type="text/javascript">
					$(document).ready(function () {
						$(document).on('click', '.praise-btn', function () {
							var $this = $(this),
								cid = $this.data('cid'),
								id = $this.data('id'),
								praise = parseInt($this.find('em').text());
				
							$.post('<?php echo url('praise/update')?>', {
								cid: cid,
								id: id,
								_token: '<?php echo csrf_token()?>'
							}, function (rs) {
								if (rs.code < 0) return qm.message(rs.message);
								$this.find('em').text(praise + 1);
							}, 'JSON');
				
							return false;
						});
					}
				</script>



<?php
include getTemplate('footer');