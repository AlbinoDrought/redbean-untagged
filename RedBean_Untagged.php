<?php

R::ext('untagged', function($type, $tagList, $addSql = '', $bindings = array() ) {
    if($tagList !== FALSE && !is_array($tagList)) {
        $tags = explode( ',', (string)$tagList);
    } else {
        $tags = $tagList;
    }

    $writer = R::getWriter();

    $assocType = $writer->getAssocTable( array( $type, 'tag' ) );
    $assocTable = $writer->esc( $assocType );
    $assocField = $type . '_id';
    $table = $writer->esc( $type );
    $slots = implode( ',', array_fill( 0, count( $tags ), '?' ) );

    $sql = "
			SELECT {$table}.*, count(tag.title) FROM {$table}
			LEFT JOIN {$assocTable} ON {$assocField} = {$table}.id
			LEFT JOIN tag ON {$assocTable}.tag_id = tag.id
			AND tag.title IN ({$slots})
			GROUP BY {$table}.id
			HAVING count(tag.title) = 0
			{$addSql}
		";

    $bindings = array_merge( $tags, $bindings );

    $rows = R::getAll($sql, $bindings);

    return R::convertToBeans($type, $rows);
});