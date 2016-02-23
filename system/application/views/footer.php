					<?php echo("<p align='right'><a href='javascript:history.back(1);'>&laquo; Back</a> | <a href='#top'>Back to top</a></p>"); ?>
				</td>
			</tr>
			<tr>
				<td>&nbsp;</td>
				<td id="footer">
					<img src="<?php echo base_url();?>images/logo_small.png" id="avatar" />
					<p><a href="http://www.uplb.edu.ph">University of the Philippines Los Baños</a> - <a href="http://ovcca.uplb.edu.ph/">Office of the Vice Chancellor for Community Affairs</a> and <a href="http://ics.uplb.edu.ph/">Institute of Computer Science.</a><br />
					<a href="<?php echo base_url()?>" />FlashDrive</a>. All rights reserved. Copyright <?php 
						$copyYear = 2011; 
						$curYear = date('Y'); 
						echo $copyYear . (($copyYear != $curYear) ? '-' . $curYear : '');
					?>.
				</td>
		</table>
	</body>
</html>