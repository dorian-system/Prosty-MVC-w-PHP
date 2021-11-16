<?php
/**
 * Klasa służąca do obsługi edytowanie danych z bazy danych dla tabeli pages
 * 
 * @package Content
 * @subpackage Model
 */
 
require_once "{$config->APP_PATH}/config/db.php";
$editenable = false;
class CreateEditContentModel extends Db {
	 /**
     * Tworzy artykuł
     * array $post
     */
	function create($post){
		if ($post['id'] != null){
		$sql = "UPDATE pages SET description='{$post['description']}', keywords='{$post['keywords']}', 
		title='{$post['title']}', category='{$post['category']}',  path='{$post['path']}', visible='{$post['visible']}', 
		content='{$post['content']}', lastmod=NOW() WHERE id={$post['id']}";
		$editenable = true;
		}else{
			$sql = "insert into pages(description, keywords, title, category, path, visible, content, created)
			values('{$post['description']}','{$post['keywords']}','{$post['title']}','{$post['category']}','{$post['path']}','{$post['visible']}', '{$post['content']}', NOW())";
		}
		$this->sql($sql);	
		return true;	
	}
	
	 /**
     * Usuwa artykuł
     * int $id identyfikator artykuł
     */
	function delete_page($id){
		$sql = 'delete from pages where id ='.$id;
		$this->sql($sql);
	}
	
	/**
     * Zwraca listę artykułów uwzględniającą dodatkowe parametry
     * string $order sposób sortowania wyników
     * @return res tablica obiektów
     */
	function list_pages($order){
		$sql = 'select id, path, title, content, category, created, lastmod, description, visible from pages order by id ' . $order;
		$res = $this->sql($sql);
		return $res;	
	}
	
	/**
     * Zwraca artykuł uwzględniającą dodatkowe parametry
     * int $id identyfikator artykuł
     * @return result obiekt
     */
	function return_page_edit($id){
		$sql = 'select description, keywords, title, category, path, content, visible from pages where id ='.$id;
		$result = $this->sql($sql);
		return $result;	
	}
} 
?>
