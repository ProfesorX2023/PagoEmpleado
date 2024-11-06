<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pago de Empleado</title>
    <link rel="stylesheet" href="/estilos.css">
</head>
<body>
    <header>
        <h1 id="centrado">PAGO DE EMPLEADO</h1>
    </header>
    <section>
        <table style="margin: 0 auto;">
            <form action="pago.php" method="post">
                <tr>
                    <td>Empleado</td>
                    <td><input type="text" name="txtEmpleado" id="txtEmpleado" size="40"></td>
                </tr>
                <tr>
                    <td>Horas Trabajadas</td>
                    <td><input type="text" name="txtHoras" id="txtHoras"></td>
                </tr>
                <tr>
                    <td>Tarifa por Hora</td>
                    <td><input type="text" name="txtTarifa" id="txtTarifa"></td>
                </tr>
                <tr>
                    <td></td>
                    <td>
                        <input type="submit" value="Procesar">
                        <input type="reset" value="Limpiar">
                    </td>
                </tr>
            </form>

            <?php
                if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                    $empleado = $_POST['txtEmpleado'];
                    $horas = $_POST['txtHoras'];
                    $tarifa = $_POST['txtTarifa'];

                    // Validar entrada
                    if (is_numeric($horas) && is_numeric($tarifa)) {
                        // Realizar los cálculos
                        $salarioBruto = $horas * $tarifa;
                        $descuentoSeguroSalud = $salarioBruto * 0.12;
                        $descuentoAfp = $salarioBruto * 0.10;
                        $salarioNeto = $salarioBruto - $descuentoSeguroSalud - $descuentoAfp;
                    } else {
                        echo "<tr><td colspan='2' style='color: red;'>Por favor, ingrese valores numéricos válidos para horas y tarifa.</td></tr>";
                    }
                }
            ?>

            <?php if(isset($salarioNeto)): ?>
                <tr>
                    <td>Empleado</td>
                    <td><?php echo htmlspecialchars($empleado); ?></td>
                </tr>
                <tr>
                    <td>Salario Bruto</td>
                    <td><?php echo number_format($salarioBruto, 2); ?></td>
                </tr>
                <tr>
                    <td>Descuento Salud</td>
                    <td><?php echo number_format($descuentoSeguroSalud, 2); ?></td>
                </tr>
                <tr>
                    <td>Descuento AFP</td>
                    <td><?php echo number_format($descuentoAfp, 2); ?></td>
                </tr>
                <tr>
                    <td>Salario Neto</td>
                    <td><?php echo number_format($salarioNeto, 2); ?></td>
                </tr>
            <?php endif; ?>
        </table>
    </section>
</body>
</html>
