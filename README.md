# RedBean Untagged Extension

This extension adds a function that finds all records without the given tags.

### Examples:

    ```php
    $tagged_videos = R::tagged('video', 'canadian');
    $untagged_videos = R::untagged('video', 'canadian'); // all videos not in $tagged_videos
    ```
### See Also:

The RedBean R::tagged function: `http://www.redbeanphp.com/index.php?p=/labels__enums__tags`	

### Requirements:

RedBean `http://www.redbeanphp.com/`

