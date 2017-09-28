<div class="container">	
	<?php echo form_open('rss/create'); ?>
		<table class="table table-responsive table-sm">
			<thead>
			<tr>
				<th >titulo</th>
				<th>informações</th>
				<th>link</th>

			</tr>
			</thead>
			<tbody>
	
		
	<?php foreach ($content as $key => $news_item): ?>
				<tr style="cursor: pointer;" class="sel" id="<?php echo $key?>">
				<td><?php echo $news_item['title'] ?></td>
				<td><?php echo $news_item['description'] ?></td>
				<td> <a target="_blank" href="<?php echo $news_item['link']?>"><?php echo $news_item['link']?></a></td>
				</tr>

	<?php endforeach; ?>
			</tbody>
		</table>
	</form>
</div>
<div class="jumbotron text-center">
  <h1>Newsletter</h1> 
</div>

<div class="container" id="newsletter">	


</div>

<script>
	var jsonString = '<?php echo str_replace("\\","\\\\",json_encode($content,JSON_UNESCAPED_SLASHES)) ?>';
	var json = $.parseJSON(jsonString);
	var ids = [];


	$(document).ready(function () {
	        $('.sel').click(function(){
			var index = ids.indexOf($(this).attr('id'));
			if (index > -1)
				ids.splice(index, 1);
			else
				ids.push($(this).attr('id'))
		
			$(this).toggleClass( "bg-success" );
			atualizaNewsletter();
		});
	});
	

	function atualizaNewsletter(){
		var content = "";
		var count = 0;
		$.each( ids, function( index, value ){
			if(count == 0 ) content += '<div class="row">';
			content +=  '<a target="_blank" href="' + json[value].link + '"> <div class="col-sm-4 well">' +
					    '<blockquote><H3>' + json[value].title + '</H3><footer> ' + json[value].author +'</footer>' + '</blockquote>' +
						'<H6>' + json[value].data + '</H6>' +
						'<h5>' + json[value].abstract + '</H5>' +
						'<h6>' + json[value].media + '</H6>' +
						'<h6>' + json[value].category + '</H6>' +
						
						'</div></a>';
			count++;
    		if(count == 3 ) { content += '</div>'; count = 0; }	
		});
		if(count < 3) content += '</div>';
		
		$("#newsletter").html(content);
	
		var maxHeight = 0;

		$(".well").each(function() {
			if ($(this).height() > maxHeight) {
				maxHeight = $(this).height();
			}
		});

		$(".well ").height(maxHeight);

	}

</script>