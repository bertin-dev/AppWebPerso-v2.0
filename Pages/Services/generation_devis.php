<?php
/**
 * Created by PhpStorm.
 * User: Supers-Pipo
 * Date: 26/02/2019
 * Time: 06h15
 */

//documentation html2pdf    http://wiki.spipu.net/doku.php
ob_start();
?>
    <style type="text/css">
       *{
           color: #717375;
       }
       hr{
           background: #717375;
           height: 1px ;
           border: none;
       }
       p{
           margin: 0;
           padding: 4mm 0 0 0;
       }
        table
        {
            width: 100%;
            font-size: 12pt;
            font-family: Helvetica;
            line-height: 6mm;
            letter-spacing: 1px;
            border-collapse: collapse;
        }
         strong
        {
            color: #000;
        }
        em{
            font-size: 9pt;
            color: #FF0000;
        }
        td.right{
            text-align: right;
        }
        h1
        {
          color: #000;
            padding: 0;
            margin: 0;
        }
        table.border td {
            border: 1px solid #CFD1D2;
            padding: 3mm 1mm;
        }
        table.border th, td.black
        {
            background: #000;
            color: #FFF;
            font-weight: normal;
            font-variant: small-caps;
            border: solid 1px #FFF;
            padding: 1mm 1mm;
            text-align: left;
        }
        td.noborder
        {
            border: none;
        }
    </style>
   <page backtop="20mm" backleft="10mm" backright="10mm" backbottom="30mm" footer="page; date;">
       <!--<page_header>

       </page_header>-->

       <page_footer>
           <hr>
           <h1>Bon de Commande</h1>
           <p>Date :</p>
           <p>Signature et cachet de l'entreprise, précéde de la mention manuscrite "Bon ppour accordé"</p>
           <p>&nbsp;</p>
           <p>&nbsp;</p>
       </page_footer>
       <table style="vertical-align: top;">
           <tr>
               <td style="width: 75%;">
                  <strong> NOM: MOUNOK <br></strong>
                   PRENOM: BERTIN <br>
                   CONTACT: 694048925 <br>
                   EMAIL: BERTIN.DEV@OUTLOOK.FR
               </td>

               <td style="width: 25%">
                   <strong>CLIENT: BEAC</strong> <br>
                   N°CONTR: 3132864213215641328

               </td>
           </tr>
       </table>

       <table style="vertical-align: bottom; margin-top: 20mm;">
           <tr>
               <td style="width: 50%;"><h1>Devis N°453</h1></td>
               <td style="width: 50%;" class="right">Emis le <?= date('d/m/Y');?></td>
           </tr>
       </table>

       <table class="border">
           <thead>
           <tr>
               <th style="width: 70%;">Description</th>
               <th style="width: 6%;">Qté</th>
               <th style="width: 12%;">P.U</th>
               <th style="width: 12%;">Montant</th>
           </tr>
           </thead>

           <tbody>
           <tr>
               <td>Systeme de Newsletter</td>
               <td>2</td>
               <td><?= number_format('3500', 2);?> FCFA</td>
               <td>7000 FCFA</td>
           </tr>

           <tr>
           <td>
               <br>
               <br>
               <br>
               <br>
               <br>
               <br>
               <br>
               <br>
               <br>
               <br>
               <br>
           </td>
               <td></td>
               <td></td>
               <td></td>
           </tr>

           <tr>
               <td colspan="2" class="noborder" style="padding: 1mm;">TVA non Applicable en Freelance</td>
               <td class="black" style="padding: 1mm;">Total : </td>
               <td style="padding: 1mm;">7000 FCFA</td>
           </tr>
           </tbody>
       </table>

   </page>
<?php
$contenu_tableau = ob_get_clean();
require ('html2pdf/html2pdf.class.php');
try{
    $pdf= new HTML2PDF('P', 'A4', 'fr');
    $pdf->pdf->SetDisplayMode('fullpage');
    $pdf->writeHTML($contenu_tableau);
    $pdf->Output('devis.pdf', 'D');
}
catch (HTML2PDF_exception $e){
    die($e);
}