describe('iaMember', function() {

    beforeEach(module('iaMember'));

    describe('formatIdFilter', function() {
        it('should apply the right format to a valid member ID', inject(function(formatIdFilter) {
            expect(formatIdFilter('123456789012')).toBe('123 456 789 012');
            expect(formatIdFilter('1 2345   \n6789 012')).toBe('123 456 789 012');
            expect(formatIdFilter('123456789012 ')).toBe('123 456 789 012');
        }));

        it('should return an empty string if a null, undefined or empty string is passed', inject(function(formatIdFilter) {
            expect(formatIdFilter('')).toBe('');
            expect(formatIdFilter(null)).toBe('');
            expect(formatIdFilter()).toBe('');
        }));
    });

});
