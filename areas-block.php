<div class="areas">
    <div class="container">
        <div class="content">
            <h2>Areas of Focus</h2>
            <?php 
                $policy_list = get_terms( array(
                    'taxonomy' => 'areas-of-focus',
                    'hide_empty' => false,
                    'meta_query' => array(
                        array(
                            'key'	  	=> 'wpcf-area-type',
                            'value'	  	=> 'policy',
                            'compare' 	=> '=',
                        )
                    ),
                ));

                $disciplinary_list = get_terms( array(
                    'taxonomy' => 'areas-of-focus',
                    'hide_empty' => false,
                    'meta_query' => array(
                        array(
                            'key'	  	=> 'wpcf-area-type',
                            'value'	  	=> 'disciplinary',
                            'compare' 	=> '=',
                        )
                    ),
                ) );                                        
            ?>
            
            <ul class="tab-nav">
                <li><a class="active" href="#tab-1">Policy Areas</a></li>
                <li><a href="#tab-2">Disciplinary Areas</a></li>
            </ul>
            <div class="tab-content active" id="tab-1">
                <ul class="areas-list policy">
                    <?php foreach($policy_list as $item) : ?>
                        <li class="equal">
                            <svg class="icon">
                                <use xlink:href="<?php echo get_template_directory_uri(); ?>/assets/svg/sprite.svg#<?php echo $item->slug; ?>"></use>
                            </svg>                                
                            <h3><?php echo $item->name; ?></h3>
                            <p><?php echo $item->description; ?></p>
                        </li>
                    <?php endforeach; ?>
                </ul>
            </div>
            <div class="tab-content" id="tab-2">
                <ul class="areas-list disciplinary">
                    <?php foreach($disciplinary_list as $item) : ?>
                        <li class="equal">
                            <svg class="icon">
                                <use xlink:href="<?php echo get_template_directory_uri(); ?>/assets/svg/sprite.svg#<?php echo $item->slug; ?>"></use>
                            </svg>                                
                            <h3><?php echo $item->name; ?></h3>
                            <p><?php echo $item->description; ?></p>
                        </li>
                    <?php endforeach; ?>
                </ul>
            </div>                
        </div>
    </div>
</div>
