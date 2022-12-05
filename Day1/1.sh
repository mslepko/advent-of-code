#!/bin/bash
input_list=./1input.txt
output_file=./1output.txt

> $output_file
total=0

while read p; do

    if [ -z "$p" ]
    then
#    	echo "Total: $total"
    	echo "$total" >> $output_file 
    	total=0
        continue
    fi

#    echo "Number: $p"
    total=$(($total + p))

done <$input_list
#echo "$total"
echo "$total" >> $output_file 
echo "Elf with most calories is carrying: "
sort -n $output_file | tail -1


sort -n 1output.txt | tail -3 > ./1last3.txt
top=0

while read p; do
#    echo "Number: $p"
    top=$(($top + p))

done <./1last3.txt
echo "Top 3 elfs are carrying calories in total: $top"

echo "Done"