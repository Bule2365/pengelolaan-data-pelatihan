<!DOCTYPE html>
<html>

<head>
    <title>Evaluation PDF</title>
    <style>
        /* Inline styles to mimic Tailwind CSS for PDF */
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }

        .container {
            width: 100%;
            max-width: 800px;
            margin: auto;
            padding: 20px;
        }

        h1 {
            font-size: 24px;
            font-weight: bold;
            margin-bottom: 20px;
            color: #333;
        }

        h2 {
            font-size: 20px;
            font-weight: bold;
            margin-bottom: 10px;
            color: #333;
        }

        h3 {
            font-size: 18px;
            font-weight: bold;
            margin-top: 20px;
            margin-bottom: 10px;
            color: #333;
        }

        p {
            font-size: 14px;
            margin: 0 0 10px 0;
            color: #666;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        thead {
            background-color: #f3f4f6;
        }

        th,
        td {
            padding: 10px;
            border: 1px solid #e5e7eb;
            text-align: left;
        }

        th {
            font-weight: bold;
            background-color: #f9fafb;
            color: #111827;
        }

        tr:nth-child(even) {
            background-color: #f9fafb;
        }

        tr:nth-child(odd) {
            background-color: #ffffff;
        }
    </style>
</head>

<body>
    <div class="container">
        <h1>Evaluation {{ $evaluation->training->post->dataPrice->training_title }}</h1>
        <h2>Trainee Information</h2>
        <p><strong>Name:</strong> {{ $evaluation->trainee->name }}</p>
        <p><strong>Evaluation Date:</strong> {{ $evaluation->created_at->format('d-m-Y') }}</p>
        <table>
            <thead>
                <tr>
                    <th>no</th>
                    <th>Section</th>
                    <th>Question</th>
                    <th>Score</th>
                    <th>Comments</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($evaluation->evaluationResponses as $response)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $response->item->section }}</td>
                        <td>{{ $response->item->question }}</td>
                        <td>{{ $response->response }}</td>
                        <td>{{ $response->comments ?? 'No comments' }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</body>

</html>
