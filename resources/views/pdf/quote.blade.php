<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Devis {{ $project->quote->reference }}</title>
    <style>
        body {
            font-family: sans-serif;
            color: #333;
            line-height: 1.5;
        }

        .header {
            margin-bottom: 50px;
        }

        .logo {
            font-size: 24px;
            font-weight: bold;
            color: #4f46e5;
        }

        .details {
            margin-bottom: 30px;
        }

        .details table {
            width: 100%;
            border-collapse: collapse;
        }

        .details td {
            vertical-align: top;
            width: 50%;
        }

        .table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 30px;
        }

        .table th {
            background: #f9fafb;
            text-align: left;
            padding: 12px;
            border-bottom: 2px solid #e5e7eb;
            font-size: 12px;
            text-transform: uppercase;
            color: #6b7280;
        }

        .table td {
            padding: 12px;
            border-bottom: 1px solid #e5e7eb;
            font-size: 14px;
        }

        .totals {
            float: right;
            width: 300px;
        }

        .totals table {
            width: 100%;
        }

        .totals td {
            padding: 5px 0;
        }

        .totals .grand-total {
            font-size: 18px;
            font-weight: bold;
            color: #4f46e5;
            border-top: 2px solid #4f46e5;
            padding-top: 10px;
            margin-top: 10px;
        }

        .footer {
            position: fixed;
            bottom: 0;
            width: 100%;
            font-size: 10px;
            color: #9ca3af;
            text-align: center;
        }
    </style>
</head>

<body>
    <div class="header">
        <div class="logo">Digital Configurator</div>
        <p>Expert en solutions digitales sur mesure</p>
    </div>

    <div class="details">
        <table>
            <tr>
                <td>
                    <strong>Émis pour :</strong><br>
                    {{ $project->user->name }}<br>
                    {{ $project->user->email }}
                </td>
                <td style="text-align: right;">
                    <strong>Devis #{{ $project->quote->reference }}</strong><br>
                    Date : {{ $project->created_at->format('d/m/Y') }}<br>
                    Validité : 30 jours
                </td>
            </tr>
        </table>
    </div>

    <h3>Objet : {{ $project->name }} ({{ $project->projectType->name }})</h3>

    <table class="table">
        <thead>
            <tr>
                <th>Description</th>
                <th style="text-align: right;">Délai (j)</th>
                <th style="text-align: right;">Prix</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>
                    <strong>Plateforme de base : {{ $project->projectType->name }}</strong><br>
                    Secteur : {{ $project->projectType->category->name }}
                </td>
                <td style="text-align: right;">{{ $project->projectType->base_duration_days }}</td>
                <td style="text-align: right;">{{ number_format($project->projectType->base_price, 2) }} €</td>
            </tr>
            @foreach($project->features as $feature)
                <tr>
                    <td>{{ $feature->name }}</td>
                    <td style="text-align: right;">+{{ $feature->impact_days }}</td>
                    <td style="text-align: right;">+{{ number_format($feature->price, 2) }} €</td>
                </tr>
            @endforeach
            @foreach($project->platforms as $platform)
                <tr>
                    <td>Option Multi-plateforme ({{ ucfirst($platform->platform_type) }})</td>
                    <td style="text-align: right;">+{{ $platform->additional_duration }}</td>
                    <td style="text-align: right;">+{{ number_format($platform->additional_price, 2) }} €</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <div class="totals">
        <table>
            <tr>
                <td>Total HT</td>
                <td style="text-align: right;">{{ number_format($project->total_price, 2) }} €</td>
            </tr>
            <tr>
                <td>Délai Total</td>
                <td style="text-align: right;">{{ $project->total_duration }} jours</td>
            </tr>
            <tr class="grand-total">
                <td>TOTAL TTC</td>
                <td style="text-align: right;">{{ number_format($project->total_price, 2) }} €</td>
            </tr>
            <tr>
                <td colspan="2" style="padding-top: 20px;">
                    <strong>Modalités de paiement :</strong><br>
                    Acompte (40%) : {{ number_format($project->quote->deposit_amount, 2) }} €<br>
                    Solde (60%) : {{ number_format($project->quote->balance_amount, 2) }} €
                </td>
            </tr>
        </table>
    </div>

    <div class="footer">
        Digital Configurator SARL - 123 Rue de l'Innovation, 75000 Paris<br>
        SIRET : 123 456 789 00012 - Capital : 10 000 €
    </div>
</body>

</html>