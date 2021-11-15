<?php
require_once "{$config->APP_PATH}/config/db.php";
$editenable = false;
class CreateEditContentModel extends Db {
	function create($post){
		if ($post['id'] != null){
		$sql = "UPDATE pages SET description='{$post['description']}', keywords='{$post['keywords']}', 
		title='{$post['title']}', alt_title='{$post['alt_title']}', category='{$post['category']}', image='{$post['image']}',alt_description='{$post['alt_description']}',  path='{$post['path']}', visible='{$post['visible']}', 
		content='{$post['content']}', booksy_id='{$post['booksy_id']}', lastmod=NOW() WHERE id={$post['id']}";
		$editenable = true;
		}else{
			$sql = "insert into pages(description, keywords, title, alt_title, category, image, alt_description, path, visible, content, booksy_id, created)
			values('{$post['description']}','{$post['keywords']}','{$post['title']}','{$post['alt_title']}','{$post['category']}','{$post['image']}','{$post['alt_description']}','{$post['path']}','{$post['visible']}','{$post['booksy_id']}','{$post['booksy_id']}',NOW())";
		}
	$this->sql($sql);	
	return true;	
	}

	function delete_page($id){
		$sql = 'delete from pages where id ='.$id;
		$this->sql($sql);
	}
	
	function list_pages($order){
		$sql = 'select id, path, title, alt_title, content, category, image, alt_description, created, lastmod, description, visible from pages order by id ' . $order;
		$res = $this->sql($sql);
		return $res;	
	}

	function return_page_edit($id){
		$sql = 'select description, keywords, title, alt_title, category, image, alt_description, path, content, booksy_id, visible from pages where id ='.$id;
		$result = $this->sql($sql);
		return $result;	
	}
} 
?>
