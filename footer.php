<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package SpacePress
 */

?>
</div><!-- /.row -->

</div><!-- /.container -->

<footer class="blog-footer">
    <p class="footer-copyright">&copy;
        <?php
            echo date_i18n(
            /* translators: Copyright date format, see https://www.php.net/date */
            _x( 'Y', 'copyright date format', 'spacepress' )
        );
        ?>
        <a href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php bloginfo( 'name' ); ?></a>
    </p><!-- .footer-copyright -->
    <p>
        <a href="#">Back to top</a>
    </p>
</footer>

</body>

</html>