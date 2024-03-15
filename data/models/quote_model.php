<?php 
class Quote
{

    private $quote;
    private $author;
    private $category;

    public function __construct(string $quote, string $author, string $category)
    {
        $this->quote = $quote;
        $this->author = $author;
        $this->category = $category;
    }

    /**
     * Gets the text of the Quote.
     *
     * @return string
     */
    public function getQuote(): string
    {
        return $this->quote;
    }

    /**
     * Gets the author of the Quote.
     *
     * @return string
     */
    public function getAuthor(): string
    {
        return $this->author;
    }

    /**
     * Gets the category of the Quote.
     *
     * @return string
     */
    public function getCategory(): string
    {
        return $this->category;
    }
}

?>