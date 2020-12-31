<?php use App\Helpers\PluginsManager;
use App\Helpers\ScriptsManager;

if ( !defined( 'CPDP_PLUGIN_DIR_NAME' ) ) {
    exit;
}

add_action( 'valpress/plugin/activated', function ( $pluginDirName, $pluginInfo ) {
//    logger( 'Plugin '.$pluginInfo->name.' activated!' );
}, 10, 2 );

add_action( 'valpress/plugin/deactivated', function ( $pluginDirName, $pluginInfo ) {
//    logger( 'Plugin '.$pluginInfo->name.' deactivated!' );
}, 10, 2 );

add_action( 'valpress/post/actions', function ( $postID ) {
    ?>
    <a href="#!" class="post-duplicate" onclick="event.preventDefault(); document.getElementById('form-post-duplicate-<?php esc_attr_e( $postID ); ?>').submit();"><?php esc_html_e( __( 'cpdp::m.Clone' ) ); ?></a>
    <form id="form-post-duplicate-<?php esc_attr_e( $postID ); ?>" class="hidden" method="post" action="<?php esc_attr_e( route( 'admin.post_duplicator.duplicate', $postID ) ); ?>">
        <?php echo csrf_field(); ?>
    </form>
    <?php
} );

add_action( 'valpress/admin/head', function () {
    ScriptsManager::enqueueStylesheet( 'post-duplicator-styles', vp_plugin_url( CPDP_PLUGIN_DIR_NAME, 'assets/styles.css' ) );
} );

/**
 * Register the path to the translation file that will be used depending on the current locale
 */
add_action( 'valpress/app/loaded', function () {
    vp_register_language_file( 'cpdp', path_combine(
        PluginsManager::getInstance()->getPluginDirPath( CPDP_PLUGIN_DIR_NAME ),
        'lang'
    ) );
} );
