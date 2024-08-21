# Teste Técnico - Rest Api Laravel

Aplicação de sistema de gerenciamento de contas e transações financeiras. A seguir, você encontrará instruções para subir o ambiente utilizando Docker Compose e uma documentação das APIs disponíveis.

## Pré-requisitos

- Docker
- Docker Compose

## Instruções para subir o ambiente

1. **Clone o repositório**

   ```sh
   git clone https://github.com/seu-usuario/seu-repositorio.git
   cd seu-repositorio
   ```

2. **Crie o arquivo .env**
    
- Copie o arquivo .env.example para .env

3. **Suba o ambiente com Docker Compose**

    ```sh
    docker-compose up -d
   ```
- A aplicação estará disponível em localhost:8000.

## Documentação das APIs ##

### Conta ###

**Criar uma Conta**

**Endpoint: POST /conta**


**Requisição:**

```json
{
    "numero_conta": 12345,
    "saldo": 100.00
}
```

**Respostas:**

- 201 Created

```json
{
    "numero_conta": 12345,
    "saldo": "100.00"
}
```

- 422 Unprocessable Entity (Exemplos de respostas de erro)

```json
{
    "errors": {
        "numero_conta": [
            "Número da conta é obrigatório",
            "Número da conta só aceita números inteiros",
            "Número da conta já existente"
        ],
        "saldo": [
            "Saldo é obrigatório",
            "Saldo só aceita números",
            "Saldo deve ser no mínimo zero"
        ]
    }
}
```

- 500 Internal Server Error

```json
{
    "message": "Não foi possível criar a conta"
}
```

**Consultar uma Conta**

**Endpoint: GET /conta**

**Requisição:**

```json
{
    "numero_conta": 12345
}
```

**Respostas:**

- 200 OK

```json
{
    "numero_conta": 12345,
    "saldo": "100.00"
}
```

- 404 Not Found

```json
{
    "message": "Conta não encontrada"
}
```

- 422 Unprocessable Entity (Exemplos de respostas de erro)

```json
{
    "errors": {
        "numero_conta": [
            "Número da conta é obrigatório",
            "Número da conta só aceita números inteiros"
        ]
    }
}
```

### Transação ###

**Criar uma Transação**

**Endpoint: POST /transacao**

**Requisição:**

```json
{
  "forma_pagamento": "D",
  "numero_conta": 12345,
  "valor": 50.00
}
```
**Respostas:**

- 201 Created

```json
{
  "numero_conta": 12345,
  "saldo": "50.00"
}
```

- 404 Not Found

```json
{
    "message": "Saldo Insuficiente"
}
```

- 422 Unprocessable Entity (Exemplos de respostas de erro)

```json
{
    "errors": {
        "numero_conta": [
            "Número da conta é obrigatório",
            "Número da conta só aceita números inteiros"
        ],
        "forma_pagamento": [
            "Forma de pagamento é obrigatória",
            "Forma de pagamento deve ser D (débito), C (crédito) ou P (pix)"
        ],
        "valor": [
            "Valor é obrigatório",
            "Valor só aceita números",
            "Valor deve ser no mínimo zero"
        ]
    }
}
```

- 500 Internal Server Error

```json
{
    "message": "Erro ao gravar transação"
}
```

