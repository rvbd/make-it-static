<?php
/**
 * View file for TOC rows. The indentation is to be done via CSS instead of hardcoded
 * This is to be included by TOC generator controller to provide the HTML of each of the rows.
 *
 * The idea is when style changes needs to be applied, we can do it here without modifying the logics too much
 *
 * User: budiartoa
 * Date: 20/03/12
 * Time: 8:16 AM
 * @copyright Copyright © Luxbet Pty Ltd. All rights reserved. http://www.luxbet.com/
 * @license http://www.opensource.org/licenses/BSD-3-Clause
 */

?>

<div class="toc">
	<span class="level_<?=$toc_level?>">
		<a href="<?=$link?>"><?=$title?></a>
	</span>
</div>