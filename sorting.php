<?php
/**
 * Swaps content in array given start and end indexes
 * @param int $start
 * @param int $end
 * @param array $arr
 * @return array $arr
 */
function swap($start, $end, $arr)
{
    $temp = $arr[$end];
    $arr[$end] = $arr[$start];
    $arr[$start] = $temp;
    return $arr;
}

/**
 * Merges two sorted arrays
 * Time complexity = O(n)
 *
 * @param array $left
 * @param array $right
 * @return array
 */
function merge($left = [], $right = [])
{

    // initialize empty result array
    $result = [];

    // initialize leftIndex = 0
    $leftIndex = 0;

    // initialize rightIndex = 0
    $rightIndex = 0;

    // loop through left and num why leftIndex < sizeof(left) and rightIndex < sizeof(right)
    while ($leftIndex < sizeof($left) && $rightIndex < sizeof($right)) {

        // check if left[leftIndex] < right[rightIndex]
        if ($left[$leftIndex] < $right[$rightIndex]) {

            // push left[leftIndex] to results array
            $result[] = $left[$leftIndex];

            // increment leftIndex
            $leftIndex++;
        } else {
            // else right[rightIndex] < left[leftIndex]
            // push right[rightIndex] to results array
            $result[] = $right[$rightIndex];

            // increment rightIndex
            $rightIndex++;
        }
    }

    // merge remaining left and right array to result
    $result = array_merge($result, array_slice($left, $leftIndex));
    $result = array_merge($result, array_slice($right, $rightIndex));

    return $result;
}

/**
 * Implements bubble sort algorithm
 * Time Complexity = O(n^2)
 *
 * @param array $nums
 * @return array $nums
 */
function bubbleSort($nums = [])
{
    // if nums array only has 1 elemnt or is empty lets just return it
    if (sizeof($nums) <= 1) {
        return $nums;
    }

    // loop through nums from index 0 to size of nums
    for ($i = 0; $i < sizeof($nums); $i++) {

        // loop through nums again to use another pointer to compare each element and bubble up to sorted position
        // we want to loop through from index 0 to size of nums - outter index - 1
        for ($j = 0; $j < sizeof($nums) - $i - 1; $j++) {
            // check if current number is greater than the next number
            if ($nums[$j] > $nums[$j + 1]) {

                // swap places
                $nums = swap($j, $j + 1, $nums);
            }
        }
    }


    // return nums
    return $nums;
}

/**
 * Implements the insertion sort algorithm
 * Time complexity = O(n^2)
 *
 * @param array $nums
 * @return array
 */
function insertionSort($nums = [])
{
    // loop through nums from i = 1 to size of nums
    for ($i = 1; $i < sizeof($nums); $i++) {

        // set our key
        $key = $nums[$i];

        // set previous compareIndex = i - 1;
        $compareIndex = $i - 1;

        // now loop to check all previous elements while compareIndex >= 0 and nums[compareIndex] > key
        while ($compareIndex >= 0 && $nums[$compareIndex] > $key) {

            // swap compareIndex with compareIndex + 1 elements
            $nums = swap($compareIndex, $compareIndex + 1, $nums);

            // decrement compareIndex
            $compareIndex--;
        }
    }

    return $nums;
}

/**
 * Implementation of the mergeSort algorithm
 * Time complexity = O(nlogn)
 *
 * @param array $nums
 * @return array
 */
function mergeSort($nums = [])
{
    // return nums if has 1 element or is empty
    if (sizeof($nums) <= 1) {
        return $nums;
    }

    // find mid point to help split array in two halves
    $mid = floor(sizeof($nums) / 2);

    // get left side
    $left = array_slice($nums, 0, $mid);

    // get right side
    $right = array_slice($nums, $mid);

    // return merge
    return merge(
    // mergeSort on left
        mergeSort($left),
        // mergeSort on right
        mergeSort($right)
    );
}

// TEST CASES
$tests = [
    [
        'test' => [0, 3, 100, 3],
        'accepted' => [0, 3, 3, 100]
    ],
    [
        'test' => [10, 3, 30, 50, 9, 2, 5, 8],
        'accepted' => [2, 3, 5, 8, 9, 10, 30, 50]
    ],
    [
        'test' => [20, 21, 5, 100, 1],
        'accepted' => [1, 5, 20, 21, 100]
    ]
];

// Loop through test cases and test them
foreach ($tests as $test_case) {

    $test_value = '[' . implode(',', $test_case['test']) . ']';
    $accepted_value = '[' . implode(',', $test_case['accepted']) . ']';

    // test bubble sort
    $bubble_sort_test = bubbleSort($test_case['test']);
    print 'Testing bubbleSort(' . $test_value . ') => ' . $accepted_value;
    print "\n";
    print "result=" . ($bubble_sort_test === $test_case['accepted'] ? 'Passed' : 'Failed with ' . print_r($bubble_sort_test, true));
    print "\n\n";

    // test merge sort
    $merge_sort_test = mergeSort($test_case['test']);
    print 'Testing mergeSort(' . $test_value . ') => ' . $accepted_value;
    print "\n";
    print "result=" . ($merge_sort_test === $test_case['accepted'] ? 'Passed' : 'Failed with ' . print_r($merge_sort_test, true));
    print "\n\n";

    // test insertion sort
    $insertion_sort_test = insertionSort($test_case['test']);
    print 'Testing insertionSort(' . $test_value . ') => ' . $accepted_value;
    print "\n";
    print "result=" . ($insertion_sort_test === $test_case['accepted'] ? 'Passed' : 'Failed with ' . print_r($insertion_sort_test, true));
    print "\n\n";

}