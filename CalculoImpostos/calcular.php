	 <fieldset>
	 <h2>Resultado</h2>
	 <table>
      <thead>
        <tr>
          <th><h4> Eventos </h4></th>
          <th><h4> Referência </h4></th>
          <th><h4> Desconto </h4></th>       
        </tr> 
      </thead>
	
<?php

	$salario = $_POST['valor'];	
	
	$resultInssTotal = InssTotal($salario);
	$resultInss = Inss($salario);
	$resultInssporcet = InssPorcent($salario);	
	$resultImpostoRenda = ImpostoRenda($resultInss);
	$resultImpostoRendaPorcent = ImpostoRendaPorcent($resultInss);
	$resultValorliquido = ValorLiquido($salario,$resultInssTotal,$resultImpostoRenda,$resultInss);
		
	$resultDesconto = $resultInssTotal + $resultImpostoRenda;
	
    echo '<tr>';
	echo '<td class=\"refDesc\">INSS</td>'; 
	echo "<td class=\"refDesc\">{$resultInssporcet}</td>";
	echo "<td class=\"refDesc\">{$resultInssTotal}</td>";	
	echo '</tr>'; 
	echo '<tr>';
	echo '<td class=\"refDesc\">IRRF</td>';
	echo "<td class=\"refDesc\">{$resultImpostoRendaPorcent}</td>";
	echo "<td class=\"refDesc\">{$resultImpostoRenda}</td>";
	echo '</tr>'; 
	echo '<tr>';		
	echo '<td class=\"refDesc\" colspan="2">Total Descontado</td>';	
	echo "<td class=\"refDesc\">{$resultDesconto}</td>";							
    echo '</tr>';
	echo '<tr>';		
	echo '<td class=\"refDesc\" colspan="2">Valor Bruto</td>';	
	echo "<td class=\"refDesc\">{$salario}</td>";							
    echo '</tr>';	
	echo '<tr>';			
	echo '<td class=\"refDesc\" colspan="2">Valor Líquido</td>';						
	echo "<td class=\"refDesc\">{$resultValorliquido}</td>";				
	echo '</tr>';
	
	function Inss($salario){
	$inss = 0;	
	$insstotal = 0;
	if($salario <= 1556.94){
		$inss = $salario*0.08;		
		$insstotal = $salario - $inss;		
	}else if ($salario >= 1556.95 && $salario <= 2594.92){
		$inss = $salario*0.09;		
		$insstotal = $salario - $inss;
	}else if ($salario >= 2594.93 && $salario <= 5189.81){
		$inss = $salario*0.11;
		$insstotal = $salario - $inss;
	}else if ($salario > 5189.82){
		$inss = 5189.82*0.11;
		$insstotal = $salario - $inss;
	}
	
	return $insstotal;
	}
	
	function InssTotal($salario){
	$inss = 0;	
	if($salario <= 1556.94){
		$inss = $salario*0.08;				
	}else if ($salario >= 1556.95 && $salario <= 2594.92){
		$inss = $salario*0.09;		
	}else if ($salario >= 2594.93 && $salario <= 5189.81){
		$inss = $salario*0.11;
	}else if ($salario > 5189.82){
		$inss = 5189.82*0.11;
	}
	return $inss;
	}
	
	function InssPorcent($salario){
	$porcent;
	if($salario <= 1556.94){
		$porcent = "8%";	
	}else if ($salario >= 1556.95 && $salario <= 2594.92){
		$porcent = "9%";	
	}else if ($salario >= 2594.93 && $salario <= 5189.81){
		$porcent = "11%";	
	}else if ($salario > 5189.82){
		$porcent = "TETO";
	}
	return $porcent;
	}
	
	function ImpostoRendaPorcent($resultInss){
	$irporcent=0;
	if ($resultInss <= 1903.98){
		$irporcent = "Isento";
	}else if ($resultInss >= 1903.99 && $resultInss <= 2826.65){
		$irporcent = "7,5%";	
	}else if ($resultInss >= 2826.66 && $resultInss <= 3751.05){
		$irporcent = "15%";
	}else if ($resultInss >= 3751.06 && $resultInss <= 4664.68){
		$irporcent = "22,5%";	
	}else if ($resultInss > 4664.69){
		$irporcent = "27,5%";	
	}	
    return $irporcent;		
	}
		
	function ImpostoRenda($resultInss){
	$ir=0;
	if ($resultInss <= 1903.98){
		$ir = 0;
	}else if ($resultInss >= 1903.99 && $resultInss <= 2826.65){
		$ir = (($resultInss*0.075) - 142.80);		
	}else if ($resultInss >= 2826.66 && $resultInss <= 3751.05){
		$ir = (($resultInss*0.15) - 354.80);		
	}else if ($resultInss >= 3751.06 && $resultInss <= 4664.68){
		$ir = (($resultInss*0.225) - 636.13);			
	}else if ($resultInss > 4664.69){
		$ir = (($resultInss*0.275) - 869.36);		
	}	
    return $ir;		
	}
	
	function ValorLiquido($salario,$resultInssTotal,$resultImpostoRenda,$resultInss){
	$valorliquido;
	if ($resultInss <= 1903.98){
		$valorliquido = $salario - $resultInssTotal - $resultImpostoRenda;
	}else if ($resultInss >= 1903.99 && $resultInss <= 2826.65){
		$valorliquido = $salario - $resultInssTotal - $resultImpostoRenda;		
	}else if ($resultInss >= 2826.66 && $resultInss <= 3751.05){
		$valorliquido = $salario - $resultInssTotal - $resultImpostoRenda;		
	}else if ($resultInss >= 3751.06 && $resultInss <= 4664.68){
		$valorliquido = $salario - $resultInssTotal - $resultImpostoRenda;			
	}else if ($resultInss > 4664.69){
		$valorliquido = $salario - $resultInssTotal - $resultImpostoRenda;		
	}	
    return $valorliquido;		
	}
?>	
    </table>
	</fieldset>