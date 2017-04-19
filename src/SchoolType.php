<?php
namespace ContactHub;

final class SchoolType
{
    use IsValidConstant;

    const PRIMARY_SCHOOL = 'PRIMARY_SCHOOL';
    const SECONDARY_SCHOOL = 'SECONDARY_SCHOOL';
    const HIGH_SCHOOL = 'HIGH_SCHOOL';
    const COLLEGE = 'COLLEGE';
    const OTHER = 'OTHER';
}