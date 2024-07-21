<?php

use GuzzleHttp\Client;

// $query = <<<'GRAPHQL'
// query {
//     user(id: 1) {
//         id
//         name
//         email
//     }
// }
// GRAPHQL;

$query = <<<'GRAPHQL'
query MyQuery {
    iuran_dsh_monthly(where: {keluarga: {sektor: {id: {_eq: 2}}}}) {
      bulan
      id
      id_keluarga
      nominal
      tanggal_wj
      keluarga {
        nama_keluarga
        sektor {
          nama
        }
      }
    }
  }
GRAPHQL;

$client = new Client();
$response = $client->post('http://103.76.120.65:8080/v1/graphql', [
    'headers' => [
        'Content-Type' => 'application/json',
        'x-hasura-admin-secret' => 'P@ssw0rd2024!!! ',
    ],
    'json' => ['query' => $query]
]);

$data = json_decode($response->getBody(), true);
echo json_encode($data);

// if (isset($data['errors'])) {
//     // Handle errors
//     foreach ($data['errors'] as $error) {
//         echo $error['message'];
//     }
// } else {
//     // Access the data
//     $user = $data['data']['user'];
//     echo 'Name: ' . $user['name'];
//     echo 'Email: ' . $user['email'];
// }


?>