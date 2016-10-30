<?php
namespace Imageclass;

       class Image{
        
       public function __construct($connection_name)
		{
			
			if(!empty($connection_name)){

				$this->connection = $connection_name;
			}
			else{
				throw new Exception("cant connect to database");
			}
		}

		/**
		*	@function name:  newCategory
		*
		*	The function adds a new picture category to the database.
		*	If the insert was successful true is returned otherwise false
		*
		*	@usage example:	$db_object->newCategory('photos from Work')
		*
		*	@param  string  category_name
		*
		*	@returns  boolean
		*/
		public function newCategory($category_name)
		{
			$statement = $this->connection->prepare('call NewCategory(?)');
			$statement->bindParam(1,$category_name);
			
			try 
			{
				$statement->execute();
				
				return true;
			}
			catch(PDOException $e)
			{
				return false;
			}
		}
		
		/**
		*	@function name:  getCategory
		*
		*	This function gets a single category info from the database.
		*  If  a category is found with the supplied id the function 
		*  returns an array with that category.  Otherwise it returns
		*  an empty array
		*
		*	@usage example:	$db_object->getCategory(5)
		*
		*	@param	int  category_id
		*
		*	@returns array
		*/
		public function getCategory($category_id)
		{
			$statement = $this->connection->prepare('call GetCategory(?)');
			$statement->bindParam(1,$category_id);
			
			try 
			{
				$statement->execute();
				
				$row = $statement->fetch(PDO::FETCH_NUM);
				return $row;
			}
			catch(PDOException $e)
			{
				return array();
			}
		}
		
		/**
		*	@function name:  updateCategory
		*
		*	The function updates information about a single category.
		*	If the update is successful true is returned else false.
		*
		*	@usage example:	$db_object->updateCategory('my kids',5);
		*
		*	@param  string  category_name
		*	@param  int  category_id
		*
		*	@returns  boolean
		*/
		public function updateCategory($category_name,$category_id)
		{
			$statement = $this->connection->prepare('call UpdateCategory(?,?)');
			$statement->bindParam(1,$category_name);
			$statement->bindParam(2,$category_id);
			
			try 
			{
				$statement->execute();
				
				return true;
			}
			catch(PDOException $e)
			{
				return false;
			}
		}
		
		/**
		*	@function name:  deleteCategory
		*
		*	The function deletes a single category form the database.
		*  Successful completion results in a true value being returned
		*	and an unsuccessful attempt returns false
		*
		*	@usage example:	$db_object->deleteCategory(5);
		*
		*	@param  int  category_id
		*
		*	@returns boolean
		*/
		public function deleteCategory($category_id)
		{
			$statement = $this->connection->prepare('call DeleteCategory(?)');
			$statement->bindParam(1,$category_id);
			
			try 
			{
				$statement->execute();
				
				return true;
			}
			catch(PDOException $e)
			{
				return false;
			}
		}
		
		/**
		*	@function name:  categoryList
		*
		*	This function returns a list of all the picture categories that
		*	exists in the dtabase.  In the event that the function fails to
		*	find any categories a empty arry is returned.
		*
		*	@usage example:	$db_object->categoryList()
		*
		*	@returns  array
		*/
		public function categoryList()
		{
			$statement = $this->connection->prepare('call CategoryList()');
			
			try 
			{
				$arr = array();
				$statement->execute();
				
				while ($row = $statement->fetch(PDO::FETCH_NUM)) 
				{
					array_push($arr,$row);
				}
				return $arr;
			}
			catch(PDOException $e)
			{
				return array();
			}
		}
		
		/**
		*	@function name:  newImageInfo
		*
		*	Inserts information about a newly loaded image into the database.
		*	If it's successful true is returned otherwise false.
		*
		*	@usage example:	$db_object->newImageInfo('kisa_min_001','images/unprocessed','Flott mynd af kisu',7);
		*
		*	@param  string name
		*	@param  string path
		*	@param  string text
		*	@param  int category
		*
		*	@returns boolean
		*/
		public function newImageInfo($name,$path,$text)
		{
			$statement = $this->connection->prepare('call NewImage(?,?,?)');
			$statement->bindParam(1,$name);
			$statement->bindParam(2,$path);
			$statement->bindParam(3,$text);
			//$statement->bindParam(4,$category);
			
			try 
			{
				$statement->execute();
				
				return true;
			}
			catch(PDOException $e)
			{
				return false;
			}
		}
		
		/**
		*	@function name:  getImageInfo
		*
		*	This function returns information about a single image.
		*	In case an image with the supplied id is not found an 
		*	empty array is returned.
		*
		*	@usage example:	$db_object->getImageInfo(504);
		*
		*	@param  int  image_id
		*
		*	@returns array
		*/
		public function getImageInfo($image_id)
		{
			$statement = $this->connection->prepare('call GetImage(?)');
			$statement->bindParam(1,$image_id);
			
			try 
			{
				$statement->execute();
				
				$row = $statement->fetch(PDO::FETCH_NUM);
				return $row;
			}
			catch(PDOException $e)
			{
				return array();
			}
		}
		
		/**
		*	@function name:  updateImageInfo
		*
		*  Use this function to update information about a image in the database.
		*	Successful update means a true is returned, otherwise false.
		*
		*	@usage example:	$db_object->updateImageInfo(398,'little Kitty','images/processed','Another kisa-mín',7);
		*
		*	@param  int  id
		*	@param  string  name
		*	@param  string  path   
		*	@param  string  text  
		*	@param  string  category 
		*
		*	@returns  boolean
		*/

		public function updateImageInfo($current_image_name,$name,$path,$text)
		{
			$statement = $this->connection->prepare('call UpdateImage(?,?,?,?)');
			$statement->bindParam(1,$current_image_name);
			$statement->bindParam(2,$name);
			$statement->bindParam(3,$path);
			$statement->bindParam(4,$text);
			
			try 
			{
				$statement->execute();
				
				return true;
			}
			catch(PDOException $e)
			{
				return false;
			}
		}
		
		/**
		*	@function name:  deleteImageInfo
		*
		*	This function deletes info about a single image.
		*	sucessful delete means a true is returned.
		*	Unsuccsessful deletion and a false is returned.
		*
		*	@usage example:	$db_object->deleteImageInfo(504);
		*
		*	@param  int  image_id
		*
		*	@returns  boolean
		*/
		public function deleteImageInfo($image_name)
		{
			$statement = $this->connection->prepare('call DeleteImage(?)');
			$statement->bindParam(1,$image_id);
			
			try 
			{
				$statement->execute();
				
				return true;
			}
			catch(PDOException $e)
			{
				return false;
			}
		}
		
		/**
		*	@function name:  imageList
		*
		*	This function returns a list if all images int the database.
		*	In the event that no images are found a empty array is returned.
		*
		*	@usage example:	$db_object->imageList();
		*
		*	@returns array.
		*/
		public function imageList()
		{
			$statement = $this->connection->prepare('call ImageList()');
			
			try 
			{
				$arr = array();
				$statement->execute();
				
				while ($row = $statement->fetch(PDO::FETCH_NUM)) 
				{
					array_push($arr,$row);
				}
				return $arr;
			}
			catch(PDOException $e)
			{
				return array();
			}
		}
	}