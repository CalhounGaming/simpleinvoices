{*
/*
* Script: version.tpl
* 	 version control template
*
* Authors:
*	 Albert Drent - aducom software
*
* Last edited:
* 	 2010-10-06
*
* License:
*	 GPL v2 or above
*
* Website:
*	http://www.simpleinvoices.org
*/
*}

<b>{$LANG.version_control}</b>
<hr />
       <div id="left">
<br />
{$LANG.version_current}: {$si_version} <br> 
{$LANG.version_installed}: {$localVersion} <br><br> 
{$LANG.version_server}: {$si_serverversion} <br>    
{$LANG.version_server_installed}: {$serverVersion} <br><br>      

<table class="buttons" >
    <tr>
        <td>
            <a href="{$downloadurl}" class="">
                <img src="{$include_dir}sys/images/mini/rtl-check.png" alt="" />
                download
            </a>
        </td>
    </tr>
</table>
<br>

{$versionControl}   

</div>
