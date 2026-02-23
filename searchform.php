<form role="search" method="get" action="<?php echo esc_url(home_url('/')); ?>" class="ea-search-form flex gap-2">
    <label for="ea-search-input" class="sr-only"><?php esc_html_e('Search','egalitarian'); ?></label>
    <input id="ea-search-input"
           type="search"
           name="s"
           value="<?php echo esc_attr(get_search_query()); ?>"
           placeholder="<?php esc_attr_e('Search...','egalitarian'); ?>"
           class="flex-1 px-4 py-3 border-2 border-gray-200 rounded-xl text-sm focus:outline-none focus:border-navy transition-colors">
    <button type="submit"
            class="px-5 py-3 bg-navy text-white font-semibold rounded-xl hover:bg-navy-light transition-colors text-sm">
        <?php esc_html_e('Search','egalitarian'); ?>
    </button>
</form>
