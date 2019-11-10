# Console-Crypto

Console-Crypto is a command-line tool using Symfony help you encode and decode a sentence with different algorithms:
Shift Encryption Algorithm, Matrix Algorithm and Reverse Algorithm from API.

## Installation

Use the composer to install **Console-Crypto**.

```bash
git clone

cd /Console-Crypto

composer install
```

## Usage

Command : "./crypto crypto"

All parameters are required and need to be entered by the same order mentioned here
- "Your Sentence" // if the sentence more than 1 word you have to surround it with quotation marks ""
- algorithmName > [shift or matrix or reverse] // case sensitive
- operation > [encrypt or decrypt] // case sensitive
 
```bash
cd /Console-Crypto

./crypto crypto "Your Sentence" algorithmName operation
```
## Examples

#### Shift Encryption Algorithm
##### Encryption
Input: "Hello World"
Result: "Khoor Zruog"

```bash
cd /Console-Crypto

./crypto crypto "Hello World" shift decrypt
```

##### Decryption
Input: "Khoor Zruog"
Result: "Hello World"

```bash
cd /Console-Crypto

./crypto crypto "Khoor Zruog" shift decrypt
```

#### Reverse Encryption Algorithm
##### Encryption
Input: "Hello World"
Result: "dlroW olleH"

```bash
cd /Console-Crypto

./crypto crypto "Hello World" reverse encrypt
```

##### Decryption
Input: "Khoor Zruog"
Result: "gourZ roohK"

```bash
cd /Console-Crypto

./crypto crypto "Khoor Zruog" reverse decrypt
```


#### Reverse Encryption Algorithm
##### Encryption

```bash
cd /Console-Crypto

./crypto crypto "Hello World" matrix encrypt
```



## Tests

```bash
cd /Console-Crypto

./vendor/bin/phpunit src/Tests/
```

## License
[MIT](https://choosealicense.com/licenses/mit/)