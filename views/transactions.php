<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Expense Tracker</title>
    <link rel="stylesheet" href="../views/style.css">
</head>
<body>
    <table>
        <!-- Section for headers -->
        <thead>
            <tr>
                <th>Date</th>
                <th>Check #</th>
                <th>Description</th>
                <th>Amount</th>
            </tr>
        </thead>

        <!-- Display all transactions -->
        <tbody>
            <?php if(!empty($transactions)): ?>
                <?php foreach($transactions as $transaction): ?>
                    <tr>
                        <td><?= formatDate($transaction['date']) ?></td>
                        <td><?= $transaction['checkNumber'] ?></td>
                        <td><?= $transaction['description'] ?></td>
                        <td>
                            <?php if($transaction['amount'] < 0): ?>
                                <span style="color: red"><?= formatDollarAmount($transaction['amount']) ?></span>
                            <?php elseif($transaction['amount'] > 0): ?>
                                <span style="color: green"><?= formatDollarAmount($transaction['amount']) ?></span>
                            <?php else: ?>
                                <?= formatDollarAmount($transaction['amount']) ?>
                            <?php endif ?>
                        </td>
                    </tr>
                <?php endforeach ?>
            <?php endif ?>
        </tbody>

        <!-- Section about totalIncome, totalExpense, and netTotal -->
        <tfoot>
            <tr>
                <th colspan="3">Total Income:</th>
                <td><?= formatDollarAmount($totals['totalIncome'])  ?? 0 ?></td>        <!-- return 0 if the left side is null, undefined, false, ... -->
            </tr>
            <tr>
                <th colspan="3">Total Expense:</th>
                <td><?= formatDollarAmount($totals['totalExpense']) ?? 0 ?></td>
            </tr>
            <tr>
                <th colspan="3">Net Total:</th>
                <td><?= formatDollarAmount($totals['netTotal']) ?? 0 ?></td>
            </tr>
        </tfoot>
    </table>
</body>
</html>