# Hamming-code-7-4-calculator

Úkol do Teorie přenosu informace. Vytvořeno pomocí PHP s webovou aplikací.

## Zadání
Vytvořte program, který bude sloužit k zabezpečení kódových slov, jejich kontrole a případné opravě. K těmto úkonům použijte metodologii Hammingova kódu. Relevantní podklady a zdroje jsou uvedeny níže.
<br /><br />Program bude řešit následující:<br /><br />
**Vyslání vybraného znaku, zakódování, následná kontrola a dekódování.**<br /><br />

Program zakóduje vybraný znak ze znakové sady viz. tabulka níže. Následně kódové slovo zabezpečí pomocí Hammingova kódu K(7,4) použitím generující matice **G** (*použít můžete matice uvedené níže*). V tomto zabezpečeném kódovém slově vygeneruje zvolený počet chyb (volte 0-3 chyby). Takto upravené (poškozené) kódové slovo program následně zkontroluje dle metodologie Hammingova kódu použitím kontrolní matice **H** (*použít můžete matice uvedené níže*), provede případnou opravu chyby a dekóduje do výstupního znaku. Vstupním parametrem bude tedy vybraný znak z tabulky a počet generovaných chyb v kódovém slově při přenosu.<br /><br />

Výstupem (to co se zobrazí po zadání vstupů a odeslání) bude vybraný vstupní znak, jeho odpovídající kódové slovo, použitá generující matice **G**, zabezpečené kódové slovo vybraného znaku, zvolený počet chyb, přijaté kódové slovo (tvar slova po zanesení chyb), kontrolní matice **H**, syndrom slova, opravené přijaté kódové slovo, přijatý znak. <br /><br />

|**Vstupní znak** |	A	|B	|C	|D	|E	|F	|G	|H	|I	|J	|K	|L	|M	|N	|O	|P |
|---|---|---|---|---|---|---|---|---|---|---|---|---|---|---|---|---|
|**Kódové slovo** |	0000	|0001	|0010	|0011	|0100	|0101	|0110	|0111	|1000	|1001	|1010	|1011	|1100	|1101	|1110	|1111 |

**<ins>Možnosti použití generující a kontrolní matice:<ins/>**<br />
Pro systematický tvar Hammingova kódu lze požít tuto generující matici:<br />
```
1  0  0  0  0  1  1
0  1  0  0  1  0  1
0  0  1  0  1  1  0
0  0  0  1  1  1  1 
```

Informační bity jsou pak v zabezpečeném kódovém slově umístěny na pozicích 1, 2, 3, 4. Výsledné zabezpečené kódové slovo bude mít tedy tvar: (inf1, inf2, inf3, inf4, p1, p2, p3) 
<br />*POZN: p - paritní bit (kontrolní, zabezpečující), inf - informační bit*


Pro NEsystematický tvar Hammingova kódu lze požít tyto dvě generující matice:
```
MATICE č.1                                                         MATICE č.2
1  1  1  0  0  0  0                                                1  1  0  1  0  0  1
1  0  0  1  1  0  0                                                0  1  0  1  0  1  0
0  1  0  1  0  1  0                                                1  1  1  0  0  0  0
1  1  0  1  0  0  1                                                1  0  0  1  1  0  0
```
*Informační bity jsou pak v zabezpečeném kódovém slově umístěny na pozicích 3, 5, 6, 7. Výsledné zabezpečené kódové slovo bude mít při použití matice č.1 tedy tvar: (p1, p2, inf1, p3, inf2, inf3, inf4) a při použití matice č.2 tvar : (p1, p2, inf3, p3, inf4, inf2, inf1). POZOR v případě použití matice č.2 jsou informační bity zpřeházené!!!</br>
Pro všechny výše uvedené generující matice lze při kontrole použít kontrolní matici ve tvaru:*
```
0  0  0  1  1  1  1
0  1  1  0  0  1  1
1  0  1  0  1  0  1
```

## Ukázka
![image](https://github.com/grasski/Hamming-code-7-4-calculator/assets/34042457/098f3abb-b1dd-486a-839d-058f866a83d7)
![image](https://github.com/grasski/Hamming-code-7-4-calculator/assets/34042457/90ddd6f8-b416-4edc-8986-a75923204675)


![image](https://github.com/grasski/Hamming-code-7-4-calculator/assets/34042457/89f44dc2-c103-4c85-9781-5b8b73c11d3d)
