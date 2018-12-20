# wordpress-news
A functinon to output news with coople parameters

It's nice to put latest news of your website aside in column. The function makes a list divided by days. You can output creation time, can highlight the titles of news by id of tags.

It'l look like this:
<blockquote>

* 11:04 <u>The title of a post #10</u>
* 10:33 <u>The title of a post #9</u>
* 09:00 <u>The title of a post #8</u>

20.12.2018

* 23:21 <u>The title of a post #7</u>
* 21:00 <u>The title of a post #6</u>
* 17:10 <u>The title of a post #5</u>
* 15:43 <u>The title of a post #4</u>
* 13:20 <u>The title of a post #3</u>
* 10:01 <u>The title of a post #2</u>
* 09:00 <u>The title of a post #1</u>
</blockquote>

Usage:

1) make some css magic in styles.css: put something like this at the end of file
```css
li.important a {
    color: #c00;
}
```

2) extend your theme functions.php with the code in this functions.php file

3) call the function somewhere in aside area of your theme like this:
```html
<ul>
    <?php get_articles_feed( 10, 101, true ) ?>
</ul>    
```
