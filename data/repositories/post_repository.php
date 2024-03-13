<?php

/**
 * Post Repository
 * 
 * This Post Repository interacts with the database to perform CRUD operations 
 * on the Post table.
 */
class PostRepository
{
    private $conn;

    /** 
     * @param mysqli $conn connection to database.
     */

    public function __construct(mysqli $conn)
    {
        $this->conn = $conn;
    }

    /**
     * Adds Post to database
     *
     * This function takes in a Post created in the PL and BLL and adds it to the database.
     *
     * @param  Post $post A Post object.
     * @return void 
     **/
    public function addPost(Post $post): bool
    {
        //TODO: Add error handling for invalid author_id.
        $query = "INSERT INTO posts (title, content, author_id, created_at, updated_at) VALUES (?, ?, ?, ?, ?)";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("ssiss", $post->getTitle(), $post->getContent(), $post->getAuthorID(), $post->getCreatedAt(), $post->getUpdatedAt());
        return $stmt->execute();
    }

    /**
     * Gets Post by id.
     *
     * This function takes in the id of a blog post and queries the databae to retrieve the Post details.
     *
     * @param  int $id ID of the post.
     * @return Post 
     */
    public function getPostById(int $id): Post
    {

        // Create a parameterized query and execute the sql statement
        $query = "SELECT id, title, content, author_id, created_at, updated_at FROM posts WHERE id = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();

        // returns null if there are no results
        if ($result->num_rows == 0) {
            return null;
        }
        // grabs the first row of the result set
        $post_data = $result->fetch_assoc();

        // create a Post object using the result from the query
        $post = new Post(
            id: $post_data['id'],
            title: $post_data['title'],
            content: $post_data['content'],
            author_id: $post_data['author_id'],
            created_at: $post_data['created_at'],
            updated_at: $post_data['updated_at']
        );

        return $post;

    }
    /**
     * Gets the Post by the title.
     *
     * This function accesses the database and returns the Post matching the title given.
     *
     * @param  string $title Title of the post.
     * @return Post
     */
    public function getPostByTitle(string $title): Post
    {
        // Create a parameterized query and execute the sql statement
        $query = "SELECT id, title, content, author_id, created_at, updated_at FROM posts WHERE title = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("s", $title);
        $stmt->execute();
        $result = $stmt->get_result();

        // check if the result is empty
        if ($result->num_rows == 0) {
            return null;
        }

        // gets the first result from the set
        $post_data = $result->fetch_assoc();

        // creates a new post object using the data in the result set.
        $post = new Post(
            id: $post_data['id'],
            title: $post_data['title'],
            content: $post_data['content'],
            author_id: $post_data['author_id'],
            created_at: $post_data['created_at'],
            updated_at: $post_data['updated_at']
        );
        return $post;

    }

    /**
     * Get post by author id.
     *
     * This function takes in the author_id of the post which is tied to a user 
     * in the database and returns the Post associated with it.
     *
     * @param  int $author_id id of the User tied to the post
     * @return Post
     */
    public function getPostByAuthorId(int $author_id): Post
    {
        //parameterized query
        $query = "SELECT id, title, content, author_id, created_at, updated_at FROM posts WHERE author_id = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("i", $author_id);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows == 0) {
            return null;
        }

        // fetches the first result and create a Post using the associated data.
        $post_data = $result->fetch_assoc();
        $post = new Post(
            id: $post_data['id'],
            title: $post_data['title'],
            content: $post_data['content'],
            author_id: $post_data['author_id'],
            created_at: $post_data['created_at'],
            updated_at: $post_data['updated_at']
        );

        return $post;
    }

    /**
     * Update the title of the post.
     *
     * This function takes in a Post and a title and updates the given Post with the new title.
     *
     * @param  Post   $post  The post to be updated.
     * @param  string $title The updated title for the post.
     * @return void
     */
    public function updateTitle(Post $post, string $title): void
    {
        // parameterized query
        $query = "UPDATE posts SET title = ? WHERE id = ?"; // sets title of specified Post with id
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("si", $title, $post->getID()); // take in the title and id parameters
        $stmt->execute();

    }

    /**
     * Updates the content of the Post object.
     *
     * This function takes in the Post object to be updated and the content to 
     * update the post with. It updates the record of the post in the database with the new content.
     *
     * @param Post   $post    The post to be updated.
     * @param string $content The content to update the post with.
     *
     * @return void
     */
    public function updateContent(Post $post, string $content): void 
    {
        // creates a query to update the post in the database with the new content
        $query = "UPDATE posts SET content = ? WHERE id = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("si", $content, $post->getID()); // binds the parameters in the query
        $stmt->execute(); // runs the query
    }
    
    /**
     * Deletes the Post from the database.
     *
     * This function takes in a Post object and deletes its record from the database.
     *
     * @param  Post $post
     * @return void
     */
    public function deletePost(Post $post): void
    {
        // parameterized query to delete the post with the specified id.
        $query = "DELETE FROM posts WHERE id = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("i", $post->getID());
        $stmt->execute();
    }
  
}
